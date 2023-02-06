<?php


namespace Sofiakb\Support;


use Closure;

/**
 * Class Helpers
 * @package Sofiakb\Support
 */
abstract class Helpers
{
    /**
     * Return the default value of the given value.
     *
     * @param mixed $value
     * @return mixed
     */
    public static function value(mixed $value): mixed
    {
        return $value instanceof Closure ? $value() : $value;
    }
}