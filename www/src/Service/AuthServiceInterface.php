<?php

namespace App\Service;

interface AuthServiceInterface
{
    public function login(): void;
    public function register(): void;
    public function logout(): void;
}
