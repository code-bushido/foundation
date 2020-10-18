# Smart Entity
**Smart Entity** concept is a powerful implementation of getters and setters entity concept. 

## Life Cycle  
It allows easy creation of the object by build-in factory and data extraction to an array (or JSON), simply it allows full-cycle like that:
```php
$entity = SmartEntity::make(['a1' => 22]);
$entity->toArray(); //['a1' => 22]
```

## Flex Entity
aka **Flexible Entity**  
Ready to use implementation with flexible properties, all you need to do is to set it using setter or by builtin factory.
```php
$entity = new \Bushido\Foundation\SmartEntity\FlexEntity();
$entity->setFirstProperty('value');
$entity->getFirstProperty(); // 'value'
$entity->toArray(); // ['first_property' => 'value']
```

### Base Methods
Replace `*` with the name of a property.

- `set*($value)`
- `get*()`
- `add*($value, [$key])`
- `toArray()`
- `make(array $components)`

### Supported Types
As this concept is completely flexible it supports all types in PHP. The only limitation is that you can't use `add*()` methods with properties that are not arrays.

## Smart Entity
*SmartyEntity* is an extended version of *FlexEntity* supporting type hinting.

> *SmartEntity* supports everything that *FlexEntity* does. 

### Property Types
```php
public const TYPE_ARRAY = 1;
public const TYPE_BOOL = 2;
public const TYPE_INT = 4;
public const TYPE_FLOAT = 8;
public const TYPE_NUMERIC = 12;
public const TYPE_STRING = 16;
public const TYPE_OBJECT = 32;
```

If wrong type get passed to `set*()` or `add*()` method then `InvalidArgumentException` would get thrown.

### Properties
To set up *SmartEntity* properties of it need to be defined.

Example:
```php
protected $properties = [
    'int_property' => self::TYPE_INT,
    'bool_property' => self::TYPE_BOOL,
    'string_property' => self::TYPE_STRING,
    'numeric_property' => self::TYPE_NUMERIC,
    'float_property' => self::TYPE_FLOAT,
    'array_property' => self::TYPE_ARRAY,
    'flex_property' => FlexEntity::class,
    'test_array' => TestEntity::class . self::EXT_ARRAY,
];
```
