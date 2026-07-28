<?php

declare(strict_types=1);

namespace LSS\Providers;

use LSS\Core\ServiceProvider;

final class CoreProvider extends ServiceProvider
{
    /**
     * Registrar bindings y singletons del núcleo.
     */
    public function register(): void
    {
        //
        // Servicios principales de LSS:
        //
        // EventDispatcher
        // Logger
        // ConfigRepository
        // Cache
        //
        // Se irán agregando conforme se implementen.
        //
    }

    /**
     * Inicialización posterior al registro.
     */
    public function boot(): void
    {
        //
        // Inicializaciones que requieran
        // servicios ya registrados.
        //
    }
}