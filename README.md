# [php-enum-helper](https://packagist.org/packages/w3lifer/php-enum-helper)

- [Installation](#installation)
- [Usage](#usage)
  - [Methods](#methods) 
  - [Enum without return type](#enum-without-return-type)
  - [Enum with `int` return type](#enum-with-int-return-type)
  - [Enum with `string` return type](#enum-with-string-return-type)
  - [Enum with replacements](#enum-with-replacements)
- [Tests](#tests)

## Installation

``` sh
composer require w3lifer/php-enum-helper
```

## Usage

### Methods

``` php
public static function getName(int|self|string $value, ?callable $callback = null): string;
public static function getNames(?callable $callback = null): array;
public static function getValues(): array;
public static function getSelectOptions(?callable $callback = null): array;
```

### Enum without return type

``` php
enum EnumWithoutReturnType
{
    use PhpEnumHelper;

    case Foo;
    case Bar;
}

EnumWithoutReturnType::getName(EnumWithoutReturnType::Foo); // Returns "Foo"
EnumWithoutReturnType::getName(EnumWithoutReturnType::Foo->name); // Returns "Foo"
EnumWithoutReturnType::getName(EnumWithoutReturnType::Foo, $callback); // Returns $callback("Foo")
EnumWithoutReturnType::getName(EnumWithoutReturnType::Foo->name, $callback); // Returns $callback("Foo")

EnumWithoutReturnType::getNames(); // Returns ["Foo", "Bar"]
EnumWithoutReturnType::getNames($callback); // Returns [$callback("Foo"), $callback("Bar")]

EnumWithoutReturnType::getValues(); // Returns ["Foo", "Bar"]

EnumWithoutReturnType::getSelectOptions(); // Returns ["Foo" => "Foo", "Bar" => "Bar"]
EnumWithoutReturnType::getSelectOptions($callback); // Returns ["Foo" => $callback("Foo"), "Bar" => $callback("Bar")]
```

### Enum with `int` return type

``` php
enum EnumWithIntReturnType: int
{
    use PhpEnumHelper;

    case Foo = 1;
    case Bar = 2;
}

EnumWithIntReturnType::getName(1); // Returns "Foo"
EnumWithIntReturnType::getName(1, $callback); // Returns $callback("Foo")

EnumWithIntReturnType::getNames(); // Returns ["Foo", "Bar"]
EnumWithIntReturnType::getNames($callback); // Returns [$callback("Foo"), $callback("Bar")]

EnumWithIntReturnType::getValues(); // Returns [1, 2]

EnumWithIntReturnType::getSelectOptions(); // Returns [1 => "Foo", 2 => "Bar"]
EnumWithIntReturnType::getSelectOptions($callback); // Returns [1 => $callback("Foo"), 2 => $callback("Bar")]
```

### Enum with `string` return type

``` php
enum EnumWithStringReturnType: string
{
    use PhpEnumHelper;

    case Foo = '1';
    case Bar = '2';
}

EnumWithStringReturnType::getName('1'); // Returns "Foo"
EnumWithStringReturnType::getName('1', $callback); // Returns $callback("Foo")

EnumWithStringReturnType::getNames(); // Returns ["Foo", "Bar"]
EnumWithStringReturnType::getNames($callback); // Returns [$callback("Foo"), $callback("Bar")]

EnumWithStringReturnType::getValues(); // Returns ["1", "2"]

EnumWithStringReturnType::getSelectOptions(); // Returns [1 => "Foo", 2 => "Bar"]
EnumWithStringReturnType::getSelectOptions($callback); // Returns [1 => $callback("Foo"), 2 => $callback("Bar")]
```

### Enum with replacements

``` php
enum EnumWithReplacements: int
{
    use PhpEnumHelper;

    const REPLACEMENTS = ['_' => ' '];

    case Foo_Bar = 1;
    case Baz_Qux = 2;
}

EnumWithReplacements::getName(1); // Returns "Foo Bar"
EnumWithReplacements::getName(1, $callback); // Returns $callback("Foo Bar")

EnumWithReplacements::getNames(); // Returns ["Foo Bar", "Baz Qux"]
EnumWithReplacements::getNames($callback); // Returns [$callback("Foo Bar"), $callback("Baz Qux")]

EnumWithReplacements::getValues(); // Returns [1, 2]

EnumWithReplacements::getSelectOptions(); // Returns [1 => "Foo Bar", 2 => "Baz Qux"]
EnumWithReplacements::getSelectOptions($callback); // Returns [1 => $callback("Foo Bar"), 2 => $callback("Baz Qux")]
```

## Tests

``` sh
make tests
```
