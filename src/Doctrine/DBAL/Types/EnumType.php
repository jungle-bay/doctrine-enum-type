<?php
/**
 * Created by PhpStorm.
 * Team: jungle
 * User: Roma Baranenko
 * Contacts: <sommelier.jungle@gmail.com>
 * Date: 12.06.17
 * Time: 23:26
 */

namespace Doctrine\DBAL\Types;


use InvalidArgumentException;
use Doctrine\DBAL\Platforms\AbstractPlatform;

abstract class EnumType extends Type {

    /**
     * @return string[]
     */
    protected abstract function getValue();


    public function convertToDatabaseValue($value, AbstractPlatform $platform) {

        if (empty($value)) {

            return $value;
        }

        if (in_array($value, $this->getValue())) {

            return $value;
        }

        throw new InvalidArgumentException('Invalid ' . $this->getName() . ' type.');
    }

    public function convertToPHPValue($value, AbstractPlatform $platform) {
        return $value;
    }

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform) {

        $allow = array_map(function ($type) {
            return '\'' . $type . '\'';
        }, $this->getValue());

        return 'SET ( ' . implode(',', $allow) . ' )';
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform) {
        return true;
    }
}
