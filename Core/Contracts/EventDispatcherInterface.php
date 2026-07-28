<?php

namespace LSS\Contracts;

interface EventDispatcherInterface
{
    public function listen(string $event, callable $listener): void;

    public function dispatch(object $event): object;
}