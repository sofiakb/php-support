<?php

use Carbon\Carbon;
use Sofiakb\Support\Config;
use Sofiakb\Support\Env;
use Sofiakb\Support\Log;

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
        return project_path() . DIRECTORY_SEPARATOR . 'storage' . ($path ? DIRECTORY_SEPARATOR . $path : null);
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

if (!function_exists('toObject')) {
    /**
     * @param mixed $data
     * @return mixed|null
     */
    function toObject($data)
    {
        return $data ? json_decode(json_encode($data)) : null;
    }
}

if (!function_exists('toArray')) {
    /**
     * @param mixed $data
     * @return array|null
     */
    function toArray($data)
    {
        return $data ? json_decode(json_encode($data), true) : null;
    }
}

if (!function_exists('get_caller_method')) {
    /**
     * @param bool $class
     * @return mixed|null
     */
    function get_caller_method($class = false)
    {
        $dbt = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 3);
        return isset($dbt[2]['function'])
            ? ($class ? $dbt[2]['class'] . '::' . $dbt[2]['function'] : $dbt[2]['function'])
            : null;
    }
}

if (!function_exists('signal')) {
    /**
     * @param Throwable $e
     * @param bool $quiet
     */
    function signal(Throwable $e, bool $quiet = false)
    {
        if ($quiet === false && php_sapi_name() == "cli") {
            echo PHP_EOL . "\033[01;33m" . $e->getFile() . "(" . $e->getLine() . ") : \033[0m" . PHP_EOL . PHP_EOL;
            echo "\033[01;31m" . $e->getMessage() . "\033[0m" . PHP_EOL . PHP_EOL;
        }
        Log::error($e);
    }
}

if (!function_exists('project_path')) {
    /**
     * Get the path to the project folder.
     *
     * @return string
     */
    function project_path()
    {
        list($scriptPath) = get_included_files();
        return dirname($scriptPath);
    }
}
