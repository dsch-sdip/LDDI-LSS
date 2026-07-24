<?php
declare(strict_types=1);

namespace LSS\Core;

/**
 * =============================================================================
 * Application
 * =============================================================================
 *
 * Main entry point of the Framework.
 */

private static ?Container $container = null;

final class Application
{
    public static function boot(): void
    {
        Config::load();
        self::container();

        /**
         * Aquí se inicializarán posteriormente:
         *
         * Logger
         * EventManager
         * Modules
         * Scheduler
         */
    }

    public static function container(): Container
    {
       if (self::$container === null) {
          self::$container = new Container();
        }
    return self::$container;
    }
    
}