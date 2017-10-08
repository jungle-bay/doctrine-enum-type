# Doctrine Enum Type

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
