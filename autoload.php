<?php

declare(strict_types=1);

/**
 * PSR-4 Autoloader
 */

spl_autoload_register(
    static function (string $class): void {

        $prefix = 'LSS\\';

        if (!str_starts_with($class, $prefix)) {
            return;
        }

        $relative = substr($class, strlen($prefix));

        $file = LSS_ROOT
            . DIRECTORY_SEPARATOR
            . str_replace('\\', DIRECTORY_SEPARATOR, $relative)
            . '.php';

        if (is_file($file)) {
            require_once $file;
        }
    }
);