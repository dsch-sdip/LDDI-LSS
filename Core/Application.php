<?php
declare(strict_types=1);

namespace LSS\Core;

use LSS\Providers\CoreProvider;

/**
 * =============================================================================
 * Application
 * =============================================================================
 *
 * Main entry point of the Framework.
 */


final class Application
{

    private static ?Container $container = null;
    private static array $providers = [];

    public static function boot(): void
    {
        Config::load();
        
        $container = self::container();

        self::registerProvider(
           new CoreProvider($container)
        );

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

    public static function registerProvider(ServiceProvider $provider): void
    {
       self::$providers[] = $provider;
    }
    
}