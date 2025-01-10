<?php

namespace App\Controller;

use App\Kernel\Controller\Controller;

class LoginController extends Controller
{
    public function index()
    {
        parent::view("login");
    }

    public function login()
    {
        $firstname = $this->request->input("FirstName");
        $lastname = $this->request->input("LastName");
        $password = $this->request->input("Password");
        $role = $this->request->input("role");

        $table = $role == "student" ? "students" : "teachers";

        $user = $this->database->first($table, [
            "FirstName" => $firstname,
            "LastName" => $lastname
        ]);

        if (!$user) {
            exit("Пользователь не найден");
        }

        if (!password_verify($password, $user["password"])) {
            exit("Не тот пароль");
        }

        $this->session->set("user_id", $user['id']);
        $this->session->set("user_roles", $role);

        $this->redirect->to('/');
    }

    public function logout() {
        $this->session->remove("user_id");
        $this->session->remove("user_role");
        $this->redirect->to("/");
    }
}
