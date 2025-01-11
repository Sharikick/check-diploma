<?php

namespace App\Kernel\Controller;

use App\Kernel\Auth\AuthInterface;
use App\Kernel\Database\DatabaseInterface;
use App\Kernel\Http\RedirectInterface;
use App\Kernel\Http\RequestInterface;
use App\Kernel\Session\SessionInterface;
use App\Kernel\Validator\ValidatorInterface;
use App\Kernel\View\ViewInterface;

abstract class Controller
{
    protected readonly ViewInterface $view;
    protected readonly RequestInterface $request;
    protected readonly RedirectInterface $redirect;
    protected readonly SessionInterface $session;
    protected readonly DatabaseInterface $db;
    protected readonly AuthInterface $auth;
    protected readonly ValidatorInterface $validator;

    public function view(string $name, string $title)
    {
        $this->view->page($name, $title);
    }

    public function setView(ViewInterface $view): void
    {
        $this->view = $view;
    }

    public function setRequest(RequestInterface $request): void
    {
        $this->request = $request;
    }

    public function setRedirect(RedirectInterface $redirect): void
    {
        $this->redirect = $redirect;
    }

    public function setSession(SessionInterface $session): void
    {
        $this->session = $session;
    }

    public function setDB(DatabaseInterface $db): void
    {
        $this->db = $db;
    }

    public function setAuth(AuthInterface $auth): void
    {
        $this->auth = $auth;
    }

    public function setValidator(ValidatorInterface $validator): void
    {
        $this->validator = $validator;
    }
}
