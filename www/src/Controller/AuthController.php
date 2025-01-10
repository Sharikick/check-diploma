<?php

namespace App\Controller;

use App\Kernel\Controller\Controller;
use App\Service\AuthService;
use App\Service\AuthServiceInterface;

class AuthController extends Controller
{
    private AuthServiceInterface $service;

    public function loginPage(): void
    {
        parent::view("login");
    }

    public function registerPage(): void
    {
        parent::view("register");
    }

    public function register(): void
    {
        $this->service()->register($this->request);
    }

    private function service(): AuthServiceInterface
    {
        if (!isset($this->service)) {
            $this->service = new AuthService(
                $this->request,
                $this->session,
                $this->redirect,
                $this->database
            );
        }

        return $this->service;
    }
}
