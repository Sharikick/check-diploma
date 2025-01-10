<?php

namespace App\Service;

use App\Kernel\Database\DatabaseInterface;
use App\Kernel\Http\RedirectInterface;
use App\Kernel\Http\RequestInterface;
use App\Kernel\Session\SessionInterface;

class AuthService implements AuthServiceInterface
{
    public function __construct(
        private readonly RequestInterface $request,
        private readonly SessionInterface $session,
        private readonly RedirectInterface $redirect,
        private readonly DatabaseInterface $db
    ) {
    }

    public function login(): void
    {

    }

    public function register(): void
    {
        $validation = $this->request->validate([
            "Name" => ["required", "min:1", "max:20"],
            "Surname" => ["min:1", "max:20"],
            "Patronymic" => ["required", "min:1", "max:20"],
            "Password" => ["required", "min:4", "max:40"],
            "Email" => ["required", "email"]
        ]);

        if (!$validation) {
            foreach ($this->request->getErrors() as $field => $errors) {
                $this->session->set($field, $errors);
            }

            $this->redirect->to('/register');
        }

        $this->db->insert("students", [
            "Name" => $this->request->input("Name"),
            "Surname" => $this->request->input("Surname"),
            "Patronymic" => $this->request->input("Patronymic"),
            "Email" => $this->request->input("Email"),
            "Password" => $this->request->input("Password")
        ]);
    }

    public function logout(): void
    {

    }
}
