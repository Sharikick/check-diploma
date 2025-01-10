<?php

namespace App\Controller;

use App\Kernel\Controller\Controller;

class RegisterController extends Controller
{
    public function index()
    {
        parent::view("register");
    }

    public function register()
    {
        $validation = $this->request->validate([
            'FirstName' => ['required', 'min:3', 'max:20'],
            'LastName' => ['required', 'min:3', 'max:20'],
            'Password' => ['required', 'min:3', 'max:40'],
        ]);

        if (!$validation) {
            foreach ($this->request->getErrors() as $field => $errors) {
                $this->session->set($field, $errors);
            }

            $this->redirect->to('/register');
        }

        if ($this->request->input("role") == "student") {
            $this->database->insert('students', [
                'FirstName' => $this->request->input('FirstName'),
                'LastName' => $this->request->input('LastName'),
                'Password' => password_hash($this->request->input('Password'), PASSWORD_DEFAULT)
            ]);
        } else {
            $this->database->insert('teachers', [
                'FirstName' => $this->request->input('FirstName'),
                'LastName' => $this->request->input('LastName'),
                'Password' => password_hash($this->request->input('Password'), PASSWORD_DEFAULT)
            ]);
        }

        $this->redirect->to('/');
    }

}
