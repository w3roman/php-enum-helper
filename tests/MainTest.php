<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use w3lifer\PhpEnumHelper\PhpEnumHelper;

final class MainTest extends TestCase
{
    public function testGetName(): void
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

        $this->assertNotSame('Bar Two', EnumWithReplacements::getName('One'));
        $this->assertSame('Foo One', EnumWithReplacements::getName('One'));

        $this->assertNotSame('Foo One Bar', EnumWithReplacements::getName('One', fn (string $name) => $name .= ' Foo'));
        $this->assertSame('Foo One Bar', EnumWithReplacements::getName('One', fn (string $name) => $name .= ' Bar'));
    }

    public function testGetNames(): void
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

        $this->assertNotSame(['Bar Two', 'Foo One',], EnumWithReplacements::getNames());
        $this->assertSame(['Foo One', 'Bar Two'], EnumWithReplacements::getNames());

        $this->assertNotSame(['Bar Two Bar', 'Foo One Bar',], EnumWithReplacements::getNames(fn (string $name) => $name .= ' Bar'));
        $this->assertSame(['Foo One Bar', 'Bar Two Bar'], EnumWithReplacements::getNames(fn (string $name) => $name .= ' Bar'));
    }

    public function testGetValues(): void
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

        $this->assertNotSame(['Two', 'One'], EnumWithReplacements::getValues());
        $this->assertSame(['One', 'Two'], EnumWithReplacements::getValues());
    }

    public function testGetSelectOptions(): void
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

        $this->assertNotSame(['Two' => 'Bar Two', 'One' => 'Foo One'], EnumWithReplacements::getSelectOptions());
        $this->assertSame(['One' => 'Foo One', 'Two' => 'Bar Two'], EnumWithReplacements::getSelectOptions());

        $this->assertNotSame(['Two' => 'Bar Two Bar', 'One' => 'Foo One Bar'], EnumWithReplacements::getSelectOptions(fn (string $name) => $name .= ' Bar'));
        $this->assertSame(['One' => 'Foo One Bar', 'Two' => 'Bar Two Bar'], EnumWithReplacements::getSelectOptions(fn (string $name) => $name .= ' Bar'));
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

enum EnumWithReplacements: string
{
    use PhpEnumHelper;

    const REPLACEMENTS = ['_' => ' '];

    case Foo_One = 'One';
    case Bar_Two = 'Two';
}
