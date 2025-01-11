<?php

namespace App\Controller;

use App\Kernel\Controller\Controller;
use App\Service\Auth\AuthService;
use App\Service\Auth\AuthServiceInterface;

class AuthController extends Controller
{
    private AuthServiceInterface $service;

    public function loginPage(): void
    {
        parent::view("login", 'Авторизация');
    }

    public function registerPage(): void
    {
        parent::view("register", 'Регистрация');
    }

    public function register(): void
    {
        $this->service()->register();
    }

    private function service(): AuthServiceInterface
    {
        if (!isset($this->service)) {
            $this->service = new AuthService(
                $this->request,
                $this->session,
                $this->redirect,
                $this->db,
                $this->validator
            );
        }

        return $this->service;
    }
}
