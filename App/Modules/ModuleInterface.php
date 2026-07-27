<?php

declare(strict_types=1);

namespace LSS\App\Modules;

interface ModuleInterface
{
    /**
     * Registrar servicios del módulo.
     */
    public function register(): void;

    /**
     * Inicializar el módulo.
     */
    public function boot(): void;
}