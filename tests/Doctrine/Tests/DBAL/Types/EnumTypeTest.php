<?php

namespace Doctrine\Test\DBAL\Types;


use Doctrine\DBAL\Types\EnumType;
use PHPUnit\Framework\TestCase;
use Doctrine\DBAL\Platforms\AbstractPlatform;

class EnumTypeTest extends TestCase {

    public function testType() {

        $platform = $this->getMockForAbstractClass(AbstractPlatform::class);

        $typeBuilder = $this->getMockBuilder(EnumType::class);
        $typeBuilder = $typeBuilder->disableOriginalConstructor();
        $typeBuilder = $typeBuilder->setMethods(array('getValue', 'getName'));

        /** @var EnumType $type */
        $type = $typeBuilder->getMock();

        /** @var AbstractPlatform $platform */
        $result = $type->convertToPHPValue('ONE', $platform);

        $this->assertEquals('ONE', $result);
    }
}
