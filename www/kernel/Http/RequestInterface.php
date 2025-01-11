<?php

namespace App\Kernel\Http;

interface RequestInterface
{
    public function getPath(): string;
    public function getMethod(): string;
    public function query(string $key, $default = null): mixed;
}
