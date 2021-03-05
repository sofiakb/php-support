<?php

namespace Ssf\Support;

use Symfony\Component\Dotenv\Dotenv;

/**
 * Class Env
 * @package Ssf\Support
 */
class Env
{

    /**
     * @var null
     */
    private static $dotenv = null;

    /**
     * @return null
     */
    public static function getDotenv()
    {
        if (is_null(static::$dotenv)) {
            $envPath = getcwd() . DIRECTORY_SEPARATOR . '.env';
            static::$dotenv = new Dotenv('APP_ENV');
            static::$dotenv->overload($envPath);
        }
        return static::$dotenv;
    }

    /**
     * Gets the value of an environment variable.
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public static function get(string $key, $default = null)
    {
        self::getDotenv();
        return isset($_ENV[$key]) ? $_ENV[$key] ?: $default : $default;
    }
}
