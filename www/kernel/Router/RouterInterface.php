<?php

namespace App\Kernel\Router;

use App\Kernel\Http\Method;

interface RouterInterface
{
    public function dispatch(Method $method, string $path): void;
    public function get(string $path, callable | array $handler): void;
    public function post(string $path, callable | array $handler): void;
    public function put(string $path, callable | array $handler): void;
    public function delete(string $path, callable | array $handler): void;
}
