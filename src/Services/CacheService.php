<?php

namespace Siravel\Services;

use Business;
use Illuminate\Support\Facades\Cache;

class CacheService
{
    private static function getBusinessKey($key): string
    {
        return Business::getCode().$key;
    }

    public static function get($key)
    {
        return Cache::get(self::getBusinessKey($key));
    }

    public static function set($key, $value)
    {
        return Cache::set(self::getBusinessKey($key), $value);
    }

    public static function clear($key)
    {
        return Cache::clear(self::getBusinessKey($key));
    }

    /**
     * @param string $key
     */
    public static function getUniversal(string $key)
    {
        return Cache::get($key);
    }

    /**
     * @param string $key
     */
    public static function setUniversal(string $key, $value)
    {
        return Cache::set($key, $value);
    }

    /**
     * @param string $key
     */
    public static function clearUniversal(string $key)
    {
        return Cache::clear($key);
    }
}
