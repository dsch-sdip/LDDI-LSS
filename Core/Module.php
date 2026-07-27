<?php

namespace LSS\Core;

abstract class Module
{
    protected Container $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Registrar servicios.
     */
    abstract public function register(): void;

    /**
     * Iniciar módulo.
     */
    abstract public function boot(): void;

    /**
     * Nombre del módulo.
     */
    abstract public function name(): string;
}