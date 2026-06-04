<?php

namespace App\Models;

use Database\Factories\SiteSettingFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

#[Fillable(['key', 'group', 'label', 'type', 'value'])]
class SiteSetting extends Model
{
    /** @use HasFactory<SiteSettingFactory> */
    use HasFactory;

    public const CACHE_KEY = 'site_settings.all';

    /**
     * Retrieve a single setting value by key, falling back to a default.
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        return static::dictionary()->get($key, $default);
    }

    /**
     * Retrieve all settings as a key/value collection (cached). Use {@see flushCache()}
     * after creating, updating, or deleting a setting.
     *
     * Cacheia um `array` puro (não a Collection) para evitar erros de
     * `__PHP_Incomplete_Class` quando o cache é deserializado em versões
     * diferentes do código.
     *
     * @return \Illuminate\Support\Collection<string, string|null>
     */
    public static function dictionary(): \Illuminate\Support\Collection
    {
        /** @var array<string, string|null> $values */
        $values = Cache::rememberForever(self::CACHE_KEY, function (): array {
            return static::query()->pluck('value', 'key')->all();
        });

        return collect($values);
    }

    /**
     * Retrieve every setting in a given group as a key/value collection.
     *
     * @return \Illuminate\Support\Collection<string, string|null>
     */
    public static function group(string $group): \Illuminate\Support\Collection
    {
        return static::query()
            ->where('group', $group)
            ->pluck('value', 'key');
    }

    public static function flushCache(): void
    {
        Cache::forget(self::CACHE_KEY);
    }
}
