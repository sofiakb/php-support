<?php

use Carbon\Carbon;
use Ssf\Support\Config;
use Ssf\Support\Env;

if (!function_exists('env')) {
    /**
     * @param $key
     * @param null $default
     * @return mixed|null
     */
    function env($key, $default = null)
    {
        return Env::get($key, $default);
    }
}

if (!function_exists('config')) {
    /**
     * Get / set the specified configuration value.
     *
     * If an array is passed as the key, we will assume you want to set an array of values.
     *
     * @param string|null $key
     * @param mixed $default
     * @return mixed
     */
    function config(?string $key = null, $default = null)
    {
        return Config::get($key, $default);
    }
}

if (!function_exists('storage_path')) {
    /**
     * Get the path to the storage folder.
     *
     * @param null $path
     * @return mixed
     */
    function storage_path($path = null)
    {
        return getcwd() . DIRECTORY_SEPARATOR . 'storage' . ($path ? DIRECTORY_SEPARATOR . $path : null);
    }
}

if (!function_exists('today')) {
    /**
     * @param null $format
     * @return mixed
     */
    function today($format = null)
    {
        return $format ? Carbon::now()->format($format) : Carbon::now();
    }
}
