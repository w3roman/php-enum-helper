<?php

declare(strict_types=1);

namespace w3lifer\PhpEnumHelper;

trait PhpEnumHelper
{
    public static function getName(int|self|string $value, ?callable $callback = null): string
    {
        if ($value instanceof self) { // For enums without return type
            $name = $value->name;
        } elseif (method_exists(self::class, 'from')) { // Enums without return type don't have `from()` method
            $name = self::from($value)->name;
        } else { // For enums without return type
            $name = $value;
        }
        $name = self::applyReplacements($name);
        return $callback ? $callback($name) : $name;
    }

    public static function getNames(?callable $callback = null): array
    {
        $names = [];
        foreach (self::cases() as $case) {
            $names[] = self::getName($case->value ?? $case->name /* For enums without return type */, $callback);
        }
        return $names;
    }

    public static function getValues(): array
    {
        $values = [];
        foreach (self::cases() as $case) {
            $values[] = $case->value ?? $case->name /* For enums without return type */;
        }
        return $values;
    }

    public static function getSelectOptions(?callable $callback = null): array
    {
        $options = [];
        foreach (self::cases() as $case) {
            $options[$case->value ?? $case->name /* For enums without return type */] =
                self::getName($case->value ?? $case->name /* For enums without return type */, $callback);
        }
        return $options;
    }

    private static function applyReplacements(string $name): string
    {
        if (defined('self::REPLACEMENTS')) {
            $name = str_replace(array_keys(self::REPLACEMENTS), array_values(self::REPLACEMENTS), $name);
        }
        return $name;
    }
}
