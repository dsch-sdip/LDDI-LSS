<?php

declare(strict_types=1);

namespace LSS\Core\Contracts;

interface ContainerInterface
{
    public function bind(string $abstract, callable|string $concrete): void;

    public function singleton(string $abstract, callable|string $concrete): void;

    public function instance(string $abstract, mixed $instance): void;

    public function make(string $abstract): mixed;

    public function has(string $abstract): bool;
}