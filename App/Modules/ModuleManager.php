<?php

declare(strict_types=1);

namespace LSS\App\Modules;

class ModuleManager
{
    /**
     * @var ModuleInterface[]
     */
    private array $modules = [];

    public function add(ModuleInterface $module): void
    {
        $this->modules[] = $module;
    }

    public function register(): void
    {
        foreach ($this->modules as $module) {
            $module->register();
        }
    }

    public function boot(): void
    {
        foreach ($this->modules as $module) {
            $module->boot();
        }
    }

    /**
     * Devuelve todos los módulos registrados.
     *
     * @return ModuleInterface[]
     */
    public function all(): array
    {
        return $this->modules;
    }
}