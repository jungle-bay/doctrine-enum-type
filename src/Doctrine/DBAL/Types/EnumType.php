<?php

namespace Doctrine\DBAL\Types;


use InvalidArgumentException;
use Doctrine\DBAL\Platforms\AbstractPlatform;

abstract class EnumType extends Type {

    /**
     * @return string[]
     */
    abstract protected function getValue();


    /**
     * {@inheritdoc}
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform) {

        if (empty($value)) {

            return $value;
        }

        if (in_array($value, $this->getValue())) {

            return $value;
        }

        throw new InvalidArgumentException('Invalid ' . $this->getName() . ' type.');
    }

    /**
     * {@inheritdoc}
     */
    public function convertToPHPValue($value, AbstractPlatform $platform) {
        return $value;
    }

    /**
     * {@inheritdoc}
     */
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform) {

        $allow = array_map(function ($type) {
            return '\'' . $type . '\'';
        }, $this->getValue());

        return 'SET ( ' . implode(',', $allow) . ' )';
    }

    /**
     * {@inheritdoc}
     */
    public function requiresSQLCommentHint(AbstractPlatform $platform) {
        return true;
    }
}
