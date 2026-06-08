<?php

namespace App\Support;

class AdminIcons
{
    /**
     * @return array<string, array{label: string, path: string}>
     */
    public static function all(): array
    {
        return config('admin-icons', []);
    }

    public static function exists(?string $name): bool
    {
        return $name !== null && $name !== '' && array_key_exists($name, self::all());
    }

    /**
     * @return array{label: string, path: string}|null
     */
    public static function find(?string $name): ?array
    {
        if (! self::exists($name)) {
            return null;
        }

        return self::all()[$name];
    }
}
