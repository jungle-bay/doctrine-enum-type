<p align="center">
    <a href="https://github.com/jungle-bay/doctrine-enum-type">
        <img height="128" src="logo.png" alt="Doctrine Logo">
    </a>
</p>

# Enum Type for [Doctrine](http://www.doctrine-project.org/)

[![Travis CI](https://img.shields.io/travis/jungle-bay/doctrine-enum-type.svg?style=flat)](https://travis-ci.org/jungle-bay/doctrine-enum-type)
[![Scrutinizer CI](https://img.shields.io/scrutinizer/g/jungle-bay/doctrine-enum-type.svg?style=flat)](https://scrutinizer-ci.com/g/jungle-bay/doctrine-enum-type)
[![Codecov](https://img.shields.io/codecov/c/github/jungle-bay/doctrine-enum-type.svg?style=flat)](https://codecov.io/gh/jungle-bay/doctrine-enum-type)

### Install

The recommended way to install is through [Composer](https://getcomposer.org/doc/00-intro.md#introduction):

```bash
composer require jungle-bay/doctrine-enum-type
```

### The simplest example of use

```php
<?php

namespace Acme\Types;


use Doctrine\DBAL\Types\EnumType;

class SexType extends EnumType {

    const NAME = 'sex_type';

    const MAN_VALUE = 'MAN';
    const WOMAN_VALUE = 'WOMAN';


    protected function getValue() {
        return array(
            self::MAN_VALUE,
            self::WOMAN_VALUE
        );
    }


    public function getName() {
        return self::NAME;
    }
}
```

##### Example use entities

```php
<?php

namespace Acme\Entities;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * 
 * @ORM\Table(
 *     name = "users"
 * )
 */
class User {
    
    /**
     * @ORM\Column(
     *     type = "sex_type"
     * )
     */
    private $sex;
}
```

#### Warning

> Do not forget to register the [type](http://docs.doctrine-project.org/projects/doctrine-orm/en/latest/cookbook/custom-mapping-types.html)!
> 
> ```php
> \Doctrine\DBAL\Types\Type::addType(SexType::NAME, SexType::class);
>
> /** @var \Doctrine\DBAL\Connection $conn */
> $conn->getDatabasePlatform()->registerDoctrineTypeMapping('sex', SexType::NAME);
> ```

### License

This bundle is under the [MIT license](http://opensource.org/licenses/MIT). See the complete license in the file: [here](https://github.com/jungle-bay/doctrine-enum-type/blob/master/license.txt).
