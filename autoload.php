<?php
declare(strict_types=1);

/**
 * =============================================================================
 * PSR-4 Autoloader
 * =============================================================================
 */

defined('ABSPATH') || exit;

spl_autoload_register(function (string $class): void {

    $prefix = 'LSS\\';

    if (strncmp($prefix, $class, strlen($prefix)) !== 0) {
        return;
    }

    $relative = substr($class, strlen($prefix));

    $relative = str_replace('\\', DIRECTORY_SEPARATOR, $relative);

    $file = LSS_ROOT . DIRECTORY_SEPARATOR .
        strtolower(dirname($relative)) .
        DIRECTORY_SEPARATOR .
        basename($relative) .
        '.php';

    if (is_file($file)) {
        require_once $file;
    }

});