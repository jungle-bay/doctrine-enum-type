<?php
/**
 * Created by PhpStorm.
 * Team: jungle
 * User: Roma Baranenko
 * Contacts: <jungle.romabb8@gmail.com>
 * Date: 05.12.17
 * Time: 18:50
 */

namespace Doctrine\DBAL\Types;


use InvalidArgumentException;
use Doctrine\DBAL\Platforms\AbstractPlatform;

/**
 * Class EnumType
 * @package Doctrine\DBAL\Types
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
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

            return null;
        } elseif (in_array($value, $this->getValue())) {

            return $value;
        }

        throw new InvalidArgumentException('Invalid "' . $this->getName() . '" type, "' . $value . '" not allowed.');
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
