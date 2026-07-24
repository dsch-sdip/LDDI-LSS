<?php
declare(strict_types=1);

namespace LSS\Core;

final class Config
{
    /**
     * Configuración cargada.
     */
    private static array $config = [];

    public static function load(): void
    {
        $file = '/etc/lss/config.php';

        if (!is_file($file)) {

            self::$config = [];

            return;

        }

        self::$config = require $file;
    }

    public static function get(
        string $key,
        mixed $default = null
    ): mixed {

        $keys = explode('.', $key);

        $config = self::$config;

        foreach ($keys as $segment) {

            if (!isset($config[$segment])) {

                return $default;

            }

            $config = $config[$segment];

        }

        return $config;

    }

}