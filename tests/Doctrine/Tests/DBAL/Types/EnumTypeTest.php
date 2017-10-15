<?php

namespace Doctrine\Test\DBAL\Types;


use PHPUnit\Framework\TestCase;
use Doctrine\DBAL\Types\EnumType;
use Doctrine\DBAL\Platforms\AbstractPlatform;

class EnumTypeTest extends TestCase {

    /**
     * @return AbstractPlatform
     */
    public function getPlatform() {
        return $this->getMockForAbstractClass(AbstractPlatform::class);
    }

    /**
     * @return EnumType
     */
    public function getType() {

        $typeBuilder = $this->getMockBuilder(EnumType::class);
        $typeBuilder = $typeBuilder->disableOriginalConstructor();
        $typeBuilder = $typeBuilder->setMethods(array('getValue', 'getName'));

        /** @var EnumType $type */
        $type = $typeBuilder->getMock();

        return $type;
    }

    public function testConvertsToPHPValue() {

        $result = $this->getType()->convertToPHPValue('ONE', $this->getPlatform());

        $this->assertEquals('ONE', $result);
    }

    public function testNullConvertsToPHPValue() {

        $result = $this->getType()->convertToPHPValue(null, $this->getPlatform());

        $this->assertEquals(null, $result);
    }
}
