<?php

namespace App\Kernel\View;

interface ViewInterface
{
    public function page(string $name, string $title): void;
    public function component(string $name, array $data, bool $repeat): void;
}
