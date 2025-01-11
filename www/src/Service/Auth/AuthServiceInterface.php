<?php

namespace App\Service\Auth;

interface AuthServiceInterface
{
    public function login(): void;
    public function register(): void;
    public function logout(): void;
}
