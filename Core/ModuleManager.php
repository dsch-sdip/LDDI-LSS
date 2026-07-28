<?php

declare(strict_types=1);

namespace LSS\Core;

class ModuleManager
{
    protected array $modules = [];

    public function register(Module $module): void
    {
        $this->modules[$module->name()] = $module;

        $module->register();
    }

    public function boot(): void
    {
        foreach ($this->modules as $module) {
            $module->boot();
        }
    }

    public function get(string $name): ?Module
    {
        return $this->modules[$name] ?? null;
    }

    public function all(): array
    {
        return $this->modules;
    }
}