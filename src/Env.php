<?php

namespace Sofiakb\Support;

use Symfony\Component\Dotenv\Dotenv;

/**
 * Class Env
 * @package Sofiakb\Support
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
            $envPath = project_path() . DIRECTORY_SEPARATOR . '.env';
            static::$dotenv = new Dotenv('APP_ENV');
            static::$dotenv->overload($envPath);
        }
        return static::$dotenv;
    }

    /**
     * Gets the value of an environment variable.
     *
     * @param string $key
     * @param mixed|null $default
     * @return mixed
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        self::getDotenv();
        return isset($_ENV[$key]) ? $_ENV[$key] ?: $default : $default;
    }
}
