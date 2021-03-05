<?php


namespace Ssf\Support;


use Exception;

class Config
{

    private static $config;

    private $path;
    private $data;
    private $file;
    private $configDot;


    public function setKey(?string $key)
    {
        $this->path = getcwd() . DIRECTORY_SEPARATOR . 'config';
        $this->file = $this->getFile(($dot = $this->getConfigDot($key)));
        $this->configDot = array_slice($dot, 1);

        $this->data = file_exists(($filename = $this->path . DIRECTORY_SEPARATOR . $this->file . ".php"))
            ? require $filename
            : [];
        return $this;
    }

    private function getConfigDot(?string &$key)
    {
        return is_null($key) ? array() : explode('.', $key);
    }

    private function getFile(?array $configDot)
    {
        return $configDot[0] ?? null;
    }

    /**
     * @return Config
     */
    public static function getInstance()
    {
        if (is_null(static::$config))
            static::$config = new static;
        return static::$config;
    }

    /**
     * Get / set the specified configuration value.
     *
     * If an array is passed as the key, we will assume you want to set an array of values.
     *
     * @param string|null $key
     * @param mixed $default
     * @return mixed
     */
    public static function get(?string $key = null, $default = null)
    {
        $config = self::getInstance()->setKey($key);
        $data = $config->data;
        $path = $config->configDot;

        foreach ($path as $str)
            $data = $data ? $data[$str] ?? null : null;
        return $data ?: $default;
    }

}