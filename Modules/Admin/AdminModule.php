<?php

namespace LSS\Modules\Admin;

use LSS\Core\Module;

class AdminModule extends Module
{
    public function name(): string
    {
        return 'admin';
    }

    public function register(): void
    {
        echo "[Admin] Registrando interfaz...\n";
    }

    public function boot(): void
    {
        echo "[Admin] Panel iniciado\n";
    }
}