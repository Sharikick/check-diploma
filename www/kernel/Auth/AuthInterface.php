<?php

namespace App\Kernel\Auth;

interface AuthInterface
{
    public function attempt(): void;
    public function check(): bool;
}
