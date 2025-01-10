<?php

namespace App\Kernel;

use App\Controller\AuthController;
use App\Controller\HomeController;
use App\Controller\LoginController;
use App\Controller\ProfileController;
use App\Controller\RegisterController;
use App\Kernel\Auth\Auth;
use App\Kernel\Auth\AuthInterface;
use App\Kernel\Database\Database;
use App\Kernel\Database\DatabaseInterface;
use App\Kernel\Http\Redirect;
use App\Kernel\Http\RedirectInterface;
use App\Kernel\Http\Request;
use App\Kernel\Http\RequestInterface;
use App\Kernel\Router\Router;
use App\Kernel\Router\RouterInterface;
use App\Kernel\Session\Session;
use App\Kernel\Session\SessionInterface;
use App\Kernel\Validator\Validator;
use App\Kernel\Validator\ValidatorInterface;
use App\Kernel\View\View;
use App\Kernel\View\ViewInterface;

class App
{
    public readonly RouterInterface $router;
    public readonly RequestInterface $request;
    public readonly ValidatorInterface $validator;
    public readonly ViewInterface $view;
    public readonly RedirectInterface $redirect;
    public readonly SessionInterface $session;
    public readonly DatabaseInterface $database;
    public readonly AuthInterface $auth;

    public function __construct()
    {
        $this->registerServices();
    }

    public function run(): void
    {
        $this->router->get('/', [HomeController::class, 'index']);
        $this->router->get('/login', [AuthController::class, 'loginPage']);
        $this->router->get('/register', [AuthController::class, 'registerPage']);
        $this->router->get('/profile' , [ProfileController::class, 'index']);

        $this->router->post('/register', [AuthController::class, 'register']);
        $this->router->post('/login', [LoginController::class, 'login']);
        $this->router->post('/logout', [LoginController::class, 'logout']);

        $this->router->dispatch($this->request->getMethod(), $this->request->getPath());
    }

    private function registerServices(): void
    {
        $this->validator = new Validator();
        $this->request = new Request();
        $this->request->setValidator($this->validator);
        $this->redirect = new Redirect();
        $this->session = new Session();
        $this->database = new Database();
        $this->auth = new Auth($this->session, $this->database);

        $this->view = new View($this->session, $this->auth);
        $this->router = new Router(
            $this->request,
            $this->view,
            $this->redirect,
            $this->session,
            $this->database
        );
    }
}
