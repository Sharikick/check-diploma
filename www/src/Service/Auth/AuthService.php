<?php

namespace App\Service\Auth;

use App\Kernel\Database\DatabaseInterface;
use App\Kernel\Http\RedirectInterface;
use App\Kernel\Http\RequestInterface;
use App\Kernel\Session\SessionInterface;
use App\Kernel\Validator\ValidatorInterface;

class AuthService implements AuthServiceInterface
{
    public function __construct(
        private readonly RequestInterface $request,
        private readonly SessionInterface $session,
        private readonly RedirectInterface $redirect,
        private readonly DatabaseInterface $db,
        private readonly ValidatorInterface $validator
    ) {
    }

    public function login(): void
    {

    }

    public function register(): void
    {
        $data = [
            "name" => $this->request->query("name"),
            "surname" => $this->request->query("surname"),
            "patronymic" => $this->request->query("patronymic"),
            "email" => $this->request->query("email"),
            "password" => $this->request->query("password")
        ];

        if (!$this->validator->validate(
            $data,
            [
                "name" => ["required", "min:1", "max:20"],
                "surname" => ["min:1", "max:20"],
                "patronymic" => ["required", "min:1", "max:20"],
                "password" => ["required", "min:4", "max:40"],
                "email" => ["required", "email"]
            ]
        )) {
            foreach ($this->validator->getErrors() as $field => $errors) {
                $this->session->set($field, $errors);
            }

            $this->redirect->to('/register');
        }

        $data["password"] = password_hash($data["password"], PASSWORD_DEFAULT);
        $data["role_id"] = "";

        try {
            $this->db->insert("users", $data);
        } catch (\PDOException $e) {
            if ($e->getCode() == 23505) {
                if (strpos($e->getMessage(), 'users_email_key') !== false) {
                    $email = $data["Email"];
                    $this->session->set("email", ["Email: $email занят"]);

                    $this->redirect->to('/register');
                } else {
                    exit("ХЗ что за ошибка");
                }
            } else {
                throw $e;
            }
        }

        $this->redirect->to('/');
    }

    public function logout(): void
    {

    }
}
