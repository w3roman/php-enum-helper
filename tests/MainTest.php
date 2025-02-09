<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use w3lifer\PhpEnumHelper\PhpEnumHelper;

final class MainTest extends TestCase
{
    public function testGetName()
    {
        // EnumWithoutReturnType

        $this->assertNotSame('Bar', EnumWithoutReturnType::getName(EnumWithoutReturnType::Foo));
        $this->assertSame('Foo', EnumWithoutReturnType::getName(EnumWithoutReturnType::Foo));

        $this->assertNotSame('Bar', EnumWithoutReturnType::getName(EnumWithoutReturnType::Foo->name));
        $this->assertSame('Foo', EnumWithoutReturnType::getName(EnumWithoutReturnType::Foo->name));

        $this->assertNotSame('FooBar', EnumWithoutReturnType::getName(EnumWithoutReturnType::Foo, fn (string $name) => $name .= 'Foo'));
        $this->assertSame('FooBar', EnumWithoutReturnType::getName(EnumWithoutReturnType::Foo, fn (string $name) => $name .= 'Bar'));

        // EnumWithIntReturnType

        $this->assertNotSame('Bar', EnumWithIntReturnType::getName(1));
        $this->assertSame('Foo', EnumWithIntReturnType::getName(1));

        $this->assertNotSame('FooBar', EnumWithIntReturnType::getName(1, fn (string $name) => $name .= 'Foo'));
        $this->assertSame('FooBar', EnumWithIntReturnType::getName(1, fn (string $name) => $name .= 'Bar'));

        // EnumWithStringReturnType

        $this->assertNotSame('Bar', EnumWithStringReturnType::getName('1'));
        $this->assertSame('Foo', EnumWithStringReturnType::getName('1'));

        $this->assertNotSame('FooBar', EnumWithStringReturnType::getName('1', fn (string $name) => $name .= 'Foo'));
        $this->assertSame('FooBar', EnumWithStringReturnType::getName('1', fn (string $name) => $name .= 'Bar'));

        // EnumWithReplacements

        $this->assertNotSame('Baz Qux', EnumWithReplacements::getName(1));
        $this->assertSame('Foo Bar', EnumWithReplacements::getName(1));

        $this->assertNotSame('Baz Qux ☺', EnumWithReplacements::getName(1, fn (string $name) => $name .= ' ☺'));
        $this->assertSame('Foo Bar ☺', EnumWithReplacements::getName(1, fn (string $name) => $name .= ' ☺'));
    }

    public function testGetNames()
    {
        // EnumWithoutReturnType

        $this->assertNotSame(['Bar', 'Foo'], EnumWithoutReturnType::getNames());
        $this->assertSame(['Foo', 'Bar'], EnumWithoutReturnType::getNames());

        $this->assertNotSame(['Foo', 'Bar'], EnumWithoutReturnType::getNames(fn (string $name) => $name .= 'Bar'));
        $this->assertSame(['FooBar', 'BarBar'], EnumWithoutReturnType::getNames(fn (string $name) => $name .= 'Bar'));

        // EnumWithIntReturnType

        $this->assertNotSame(['Bar', 'Foo'], EnumWithIntReturnType::getNames());
        $this->assertSame(['Foo', 'Bar'], EnumWithIntReturnType::getNames());

        $this->assertNotSame(['Foo', 'Bar'], EnumWithIntReturnType::getNames(fn (string $name) => $name .= 'Bar'));
        $this->assertSame(['FooBar', 'BarBar'], EnumWithIntReturnType::getNames(fn (string $name) => $name .= 'Bar'));

        // EnumWithStringReturnType

        $this->assertNotSame(['Bar', 'Foo'], EnumWithStringReturnType::getNames());
        $this->assertSame(['Foo', 'Bar'], EnumWithStringReturnType::getNames());

        $this->assertNotSame(['Foo', 'Bar'], EnumWithStringReturnType::getNames(fn (string $name) => $name .= 'Bar'));
        $this->assertSame(['FooBar', 'BarBar'], EnumWithStringReturnType::getNames(fn (string $name) => $name .= 'Bar'));

        // EnumWithReplacements

        $this->assertNotSame(['Baz Qux', 'Foo Bar',], EnumWithReplacements::getNames());
        $this->assertSame(['Foo Bar', 'Baz Qux'], EnumWithReplacements::getNames());

        $this->assertNotSame(['Baz Qux ☺', 'Foo Bar ☺',], EnumWithReplacements::getNames(fn (string $name) => $name .= ' ☺'));
        $this->assertSame(['Foo Bar ☺', 'Baz Qux ☺'], EnumWithReplacements::getNames(fn (string $name) => $name .= ' ☺'));
    }

    public function testGetValues()
    {
        // EnumWithoutReturnType

        $this->assertNotSame(['Bar', 'Foo'], EnumWithoutReturnType::getValues());
        $this->assertSame(['Foo', 'Bar'], EnumWithoutReturnType::getValues());

        // EnumWithIntReturnType

        $this->assertNotSame([2, 1], EnumWithIntReturnType::getValues());
        $this->assertSame([1, 2], EnumWithIntReturnType::getValues());

        // EnumWithStringReturnType

        $this->assertNotSame(['2', '1'], EnumWithStringReturnType::getValues());
        $this->assertSame(['1', '2'], EnumWithStringReturnType::getValues());

        // EnumWithReplacements

        $this->assertNotSame([2, 1], EnumWithReplacements::getValues());
        $this->assertSame([1, 2], EnumWithReplacements::getValues());
    }

    public function testGetSelectOptions()
    {
        // EnumWithoutReturnType

        $this->assertNotSame(['Bar' => 'Bar', 'Foo' => 'Foo'], EnumWithoutReturnType::getSelectOptions());
        $this->assertSame(['Foo' => 'Foo', 'Bar' => 'Bar'], EnumWithoutReturnType::getSelectOptions());

        $this->assertNotSame(['Bar' => 'BarBar', 'Foo' => 'FooBar'], EnumWithoutReturnType::getSelectOptions(fn (string $name) => $name .= 'Bar'));
        $this->assertSame(['Foo' => 'FooBar', 'Bar' => 'BarBar'], EnumWithoutReturnType::getSelectOptions(fn (string $name) => $name .= 'Bar'));

        // EnumWithIntReturnType

        $this->assertNotSame([2 => 'Bar', 1 => 'Foo'], EnumWithIntReturnType::getSelectOptions());
        $this->assertSame([1 => 'Foo', 2 => 'Bar'], EnumWithIntReturnType::getSelectOptions());

        $this->assertNotSame([2 => 'BarBar', 1 => 'FooBar'], EnumWithIntReturnType::getSelectOptions(fn (string $name) => $name .= 'Bar'));
        $this->assertSame([1 => 'FooBar', 2 => 'BarBar'], EnumWithIntReturnType::getSelectOptions(fn (string $name) => $name .= 'Bar'));

        // EnumWithStringReturnType

        $this->assertNotSame([2 => 'Bar', 1 => 'Foo'], EnumWithStringReturnType::getSelectOptions());
        $this->assertSame([1 => 'Foo', 2 => 'Bar'], EnumWithStringReturnType::getSelectOptions());

        $this->assertNotSame([2 => 'BarBar', 1 => 'FooBar'], EnumWithStringReturnType::getSelectOptions(fn (string $name) => $name .= 'Bar'));
        $this->assertSame([1 => 'FooBar', 2 => 'BarBar'], EnumWithStringReturnType::getSelectOptions(fn (string $name) => $name .= 'Bar'));

        // EnumWithReplacements

        $this->assertNotSame([2 => 'Baz Qux', 1 => 'Foo Bar'], EnumWithReplacements::getSelectOptions());
        $this->assertSame([1 => 'Foo Bar', 2 => 'Baz Qux'], EnumWithReplacements::getSelectOptions());

        $this->assertNotSame([2 => 'Baz Qux ☺', 1 => 'Foo Bar ☺'], EnumWithReplacements::getSelectOptions(fn (string $name) => $name .= ' ☺'));
        $this->assertSame([1 => 'Foo Bar ☺', 2 => 'Baz Qux ☺'], EnumWithReplacements::getSelectOptions(fn (string $name) => $name .= ' ☺'));
    }
}

enum EnumWithoutReturnType
{
    use PhpEnumHelper;

    case Foo;
    case Bar;
}

enum EnumWithIntReturnType: int
{
    use PhpEnumHelper;

    case Foo = 1;
    case Bar = 2;
}

enum EnumWithStringReturnType: string
{
    use PhpEnumHelper;

    case Foo = '1';
    case Bar = '2';
}

enum EnumWithReplacements: int
{
    use PhpEnumHelper;

    const REPLACEMENTS = ['_' => ' '];

    case Foo_Bar = 1;
    case Baz_Qux = 2;
}
