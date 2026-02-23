<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $fillable = ['key', 'value'];

    public static function get(string $key, mixed $default = null): mixed
    {
        $setting = Cache::remember("setting.{$key}", 300, fn () => static::where('key', $key)->first());
        return $setting ? $setting->value : $default;
    }

    public static function set(string $key, mixed $value): void
    {
        static::updateOrCreate(['key' => $key], ['value' => is_string($value) ? $value : json_encode($value)]);
        Cache::forget("setting.{$key}");
    }

    public static function getInt(string $key, int $default = 0): int
    {
        return (int) static::get($key, $default);
    }

    public static function getBool(string $key, bool $default = false): bool
    {
        $v = static::get($key, $default);
        return filter_var($v, FILTER_VALIDATE_BOOLEAN);
    }
}
