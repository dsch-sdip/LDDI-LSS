<?php

namespace LSS\Core;

class Event
{
    public function __construct(
        public readonly string $name,
        public array $payload = []
    ) {}
}