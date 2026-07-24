<?php

declare(strict_types=1);

namespace LSS\Core;

use LSS\Core\Contracts\ContainerInterface;
use RuntimeException;
use ReflectionClass;
use ReflectionNamedType;

final class Container implements ContainerInterface
{
    /**
     * @var array<string,mixed>
     */
    private array $bindings = [];

    /**
     * @var array<string,mixed>
     */
    private array $instances = [];

    /**
     * @var array<string,bool>
     */
    private array $shared = [];

    public function bind(string $abstract, callable|string $concrete): void
    {
        $this->bindings[$abstract] = $concrete;
    }

    public function singleton(string $abstract, callable|string $concrete): void
    {
        $this->bindings[$abstract] = $concrete;
        $this->shared[$abstract] = true;
    }

    public function instance(string $abstract, mixed $instance): void
    {
        $this->instances[$abstract] = $instance;
    }

    public function has(string $abstract): bool
    {
        return isset($this->bindings[$abstract])
            || isset($this->instances[$abstract]);
    }

    public function make(string $abstract): mixed
    {
        if (isset($this->instances[$abstract])) {
            return $this->instances[$abstract];
        }

        $object = $this->resolve($abstract);

        if (isset($this->shared[$abstract])) {
            $this->instances[$abstract] = $object;
        }

        return $object;
    }

    private function resolve(string $abstract): mixed
    {
        $concrete = $this->bindings[$abstract] ?? $abstract;

        if (is_callable($concrete)) {
            return $concrete($this);
        }

        if (! class_exists($concrete)) {
            throw new RuntimeException(
                sprintf('Class [%s] not found.', $concrete)
            );
        }

        $reflection = new ReflectionClass($concrete);

        if (! $reflection->isInstantiable()) {
            throw new RuntimeException(
                sprintf('Class [%s] is not instantiable.', $concrete)
            );
        }

        $constructor = $reflection->getConstructor();

        if ($constructor === null) {
            return new $concrete();
        }

        $dependencies = [];

        foreach ($constructor->getParameters() as $parameter) {

            $type = $parameter->getType();

            /*
            * Parámetro sin tipo
            */
            if ($type === null) {

                if ($parameter->isDefaultValueAvailable()) {
                    $dependencies[] = $parameter->getDefaultValue();
                    continue;
                }

                throw new RuntimeException(
                    sprintf(
                        'Cannot resolve parameter "$%s" in %s::__construct().',
                        $parameter->getName(),
                        $concrete
                    )
                );
            }

            /*
            * Tipo escalar
            */
            if ($type instanceof ReflectionNamedType && $type->isBuiltin()) {

                if ($parameter->isDefaultValueAvailable()) {
                    $dependencies[] = $parameter->getDefaultValue();
                    continue;
                }

                throw new RuntimeException(
                    sprintf(
                        'Cannot autowire builtin type "%s" for parameter "$%s" in %s::__construct().',
                        $type->getName(),
                        $parameter->getName(),
                        $concrete
                    )
                );
            }

            /*
            * Tipo nullable
            */
            if ($type instanceof ReflectionNamedType && $type->allowsNull()) {

                try {

                    $dependencies[] = $this->make($type->getName());

                } catch (RuntimeException) {

                    $dependencies[] = null;
                }

                continue;
            }

            /*
            * Clase normal
            */
            $dependencies[] = $this->make($type->getName());
        }

        return $reflection->newInstanceArgs($dependencies);
    }
}