<?php

namespace App\Kernel\Router;

interface RouterInterface
{
    public function dispatch(): void;
    public function get(string $path, array $handler): void;
    public function post(string $path, array $handler): void;
}
