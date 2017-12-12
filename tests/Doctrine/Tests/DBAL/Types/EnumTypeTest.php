<?php
/**
 * Created by PhpStorm.
 * Team: jungle
 * User: Roma Baranenko
 * Contacts: <jungle.romabb8@gmail.com>
 * Date: 05.12.17
 * Time: 18:50
 */

namespace Doctrine\Test\DBAL\Types;


use PHPUnit\Framework\TestCase;
use Doctrine\DBAL\Types\EnumType;
use Doctrine\DBAL\Platforms\AbstractPlatform;

/**
 * Class EnumTypeTest
 * @package Doctrine\Test\DBAL\Types
 * @author Roma Baranenko <jungle.romabb8@gmail.com>
 */
class EnumTypeTest extends TestCase {

    /**
     * @return AbstractPlatform
     */
    public function getPlatform() {

        /** @var AbstractPlatform $mockPlatform */
        $mockPlatform = $this->getMockForAbstractClass(AbstractPlatform::class);

        return $mockPlatform;
    }

    /**
     * @return EnumType
     */
    public function getType() {

        $mockBuilder = $this->getMockBuilder(EnumType::class);
        $mockBuilder = $mockBuilder->disableOriginalConstructor();
        $mockBuilder = $mockBuilder->setMethods(array('getValue', 'getName'));

        $mock = $mockBuilder->getMock();
        $mock->method('getName')->will($this->returnValue('test'));
        $mock->method('getValue')->will($this->returnValue(array('GET', 'SET')));

        /** @var EnumType $mock */
        return $mock;
    }


    public function testConvertToDatabaseNullValue() {

        $result = $this->getType()->convertToDatabaseValue(null, $this->getPlatform());

        $this->assertNull($result);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testConvertToDatabaseValueNotAllowed() {

        $this->getType()->convertToDatabaseValue('NOT_ALLOWED', $this->getPlatform());
    }

    public function testConvertToDatabaseValue() {

        $result = $this->getType()->convertToDatabaseValue('GET', $this->getPlatform());

        $this->assertEquals('GET', $result);
    }

    public function testConvertToPHPNullValue() {

        $result = $this->getType()->convertToPHPValue(null, $this->getPlatform());

        $this->assertNull($result);
    }

    public function testConvertToPHPValue() {

        $result = $this->getType()->convertToPHPValue('TEST', $this->getPlatform());

        $this->assertEquals('TEST', $result);
    }

    public function testGetSQLDeclaration() {

        $result = $this->getType()->getSQLDeclaration(array(), $this->getPlatform());

        $this->assertEquals('SET ( \'GET\',\'SET\' )', $result);
    }

    public function testRequiresSQLCommentHint() {

        $this->assertTrue($this->getType()->requiresSQLCommentHint($this->getPlatform()));
    }
}
