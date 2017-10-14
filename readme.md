# Doctrine Enum Type

[![Travis CI](https://img.shields.io/travis/jungle-bay/doctrine-enum-type.svg?style=flat)](https://travis-ci.org/jungle-bay/doctrine-enum-type)
[![Scrutinizer CI](https://img.shields.io/scrutinizer/g/jungle-bay/doctrine-enum-type.svg?style=flat)](https://scrutinizer-ci.com/g/jungle-bay/doctrine-enum-type)
[![Codecov](https://img.shields.io/codecov/c/github/jungle-bay/doctrine-enum-type.svg?style=flat)](https://codecov.io/gh/jungle-bay/doctrine-enum-type)
[![SensioLabsInsight](https://img.shields.io/sensiolabs/i/d630c226-36d3-4e03-ba2b-04a4a8751af6.svg?style=flat)](https://insight.sensiolabs.com/projects/d630c226-36d3-4e03-ba2b-04a4a8751af6)

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

Do not forget to register the type!
