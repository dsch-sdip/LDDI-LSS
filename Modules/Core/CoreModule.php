<?php

namespace LSS\Modules\Core;

use LSS\Core\Module;

class CoreModule extends Module
{
    public function name(): string
    {
        return 'core';
    }

    public function register(): void
    {
        echo "[Core] Registrando servicios...\n";
    }

    public function boot(): void
    {
        echo "[Core] Iniciado\n";
    }
}