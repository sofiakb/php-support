<?php
/**
 * This file contains Log class
 *
 * @author Akbly Sofiane <sofiane.akbly@gmail.com>
 */

namespace Sofiakb\Support;


use Throwable;

/**
 * Class Log
 * @package Sofiakb\Support
 */
class Log
{
    /**
     * @param $level
     * @param $data
     * @param null $channel
     * @return bool
     */
    protected static function write($level, $data, $channel = null): bool
    {
        $data = "[" . today('Y-m-d H:i:s') . "] " . env('APP_ENV', 'local') . "." . strtoupper($level) . ": " . $data;
        $path = storage_path('logs' . (!(!str_contains($channel, DIRECTORY_SEPARATOR)) ? $channel : ''));
        return !(!is_dir($path) && !mkdir($path, 0777, true)) && !(file_put_contents($path . DIRECTORY_SEPARATOR . ($channel ? str_replace(DIRECTORY_SEPARATOR, '', $channel) : 'log') . "-" . today('Y-m-d') . ".log", $data . PHP_EOL, FILE_APPEND) === false);
    }

    /**
     * @param $message
     * @param null $channel
     * @return bool
     */
    public static function error($message, $channel = null): bool
    {
        if ($message instanceof Throwable) {
            $message = $message->getMessage() . " " . $message->getFile() . "(" . $message->getLine() . ")" . PHP_EOL . $message->getTraceAsString();
        }
        return self::write('error', $message, $channel ?: '/errors');
    }

    /**
     * @param $message
     * @param null $channel
     * @return bool
     */
    public static function info($message, $channel = null): bool
    {
        return self::write('info', $message, $channel);
    }

    /**
     * @param $message
     * @param null $channel
     * @return bool
     */
    public static function debug($message, $channel = null): bool
    {
        return self::write('debug', $message, $channel);
    }

    /**
     * @param $message
     * @param null $channel
     * @return bool
     */
    public static function success($message, $channel = null): bool
    {
        return self::write('success', $message, $channel);
    }

}