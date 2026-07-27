<?php

declare(strict_types=1);

namespace LSS\Core;

abstract class ServiceProvider
{
    protected Container $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Registrar bindings y singletons.
     */
    abstract public function register(): void;

    /**
     * Inicializar servicios una vez registrados.
     */
    public function boot(): void
    {
        // Opcional para los providers.
    }
}