<?php

namespace FAFI\config;

class Settings
{
    protected string $path;
    protected $settings;
    private static $instance;


    private function __construct()
    {
        $this->path = PATH_APP . 'config' . DS . 'settings.ini';
    }

    private function init()
    {
        $this->settings = parse_ini_file($this->path, true);
    }


    /**
     * @param string $key
     * @return string|array|null
     */
    public function get(string $key)
    {
        if (!isset($this->settings)) {
            $this->init();
        }
        if (empty($this->settings)) {
            return null;
        }

        $keys = explode('/', $key);
        $settings = $this->settings;
        foreach ($keys as $key) {
            $settings = array_key_exists($key, $settings) ? $settings[$key] : null;
        }

        return $settings;
    }

    public static function getInstance(): Settings
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}
