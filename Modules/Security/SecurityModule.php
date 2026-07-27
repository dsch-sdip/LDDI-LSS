<?php

namespace LSS\Modules\Security;

use LSS\Core\Module;

class SecurityModule extends Module
{
    public function name(): string
    {
        return 'security';
    }

    public function register(): void
    {
        echo "[Security] Registrando protecciones...\n";
    }

    public function boot(): void
    {
        echo "[Security] Escudos activos\n";
    }
}