# Enum Type for [Doctrine](http://www.doctrine-project.org/)

[![Travis CI](https://img.shields.io/travis/jungle-bay/doctrine-enum-type.svg?style=flat)](https://travis-ci.org/jungle-bay/doctrine-enum-type)
[![Scrutinizer CI](https://img.shields.io/scrutinizer/g/jungle-bay/doctrine-enum-type.svg?style=flat)](https://scrutinizer-ci.com/g/jungle-bay/doctrine-enum-type)
[![Codecov](https://img.shields.io/codecov/c/github/jungle-bay/doctrine-enum-type.svg?style=flat)](https://codecov.io/gh/jungle-bay/doctrine-enum-type)
[![SensioLabsInsight](https://img.shields.io/sensiolabs/i/d630c226-36d3-4e03-ba2b-04a4a8751af6.svg?style=flat)](https://insight.sensiolabs.com/projects/d630c226-36d3-4e03-ba2b-04a4a8751af6)

### Install

The recommended way to install is through [Composer](https://getcomposer.org):

```bash
composer require jungle-bay/doctrine-enum-type
```

### The simplest example of use

```php
<?php

namespace Acme\Types;


use Doctrine\DBAL\Types\EnumType;

class SexType extends EnumType {

    const MAN = 'MAN';
    const WOMAN = 'WOMAN';


    protected function getValue() {
        return array(
            self::MAN,
            self::WOMAN
        );
    }


    public function getName() {
        return 'sex_type';
    }
}
```

##### Example use entities

```php
<?php

use Doctrine\ORM\Mapping as ORM;

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

> Do not forget to register the type!
> 
> ```php
> use Doctrine\DBAL\Types\Type;
> 
> Type::addType('sex_type', SexType::class);
> 
> $conn->getDatabasePlatform()->registerDoctrineTypeMapping('sex', 'sex_type');
> ```

### License

This bundle is under the [MIT license](http://opensource.org/licenses/MIT). See the complete license in the file: [here](https://github.com/jungle-bay/doctrine-enum-type/blob/master/license.txt).
