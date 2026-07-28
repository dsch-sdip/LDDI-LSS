<?php

namespace LSS\Core;

use LSS\Contracts\EventDispatcherInterface;

class EventDispatcher implements EventDispatcherInterface
{
    protected array $listeners = [];

    public function listen(string $event, callable $listener): void
    {
        $this->listeners[$event][] = $listener;
    }

    public function dispatch(object $event): object
    {
        if (!isset($this->listeners[$event->name])) {
            return $event;
        }

        foreach ($this->listeners[$event->name] as $listener) {
            $listener($event);
        }

        return $event;
    }
}