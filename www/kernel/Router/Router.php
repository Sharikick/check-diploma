<?php

namespace App\Kernel\Router;

use App\Kernel\Auth\Auth;
use App\Kernel\Auth\AuthInterface;
use App\Kernel\Database\Database;
use App\Kernel\Database\DatabaseInterface;
use App\Kernel\Http\Redirect;
use App\Kernel\Http\RedirectInterface;
use App\Kernel\Http\Request;
use App\Kernel\Http\RequestInterface;
use App\Kernel\Session\Session;
use App\Kernel\Session\SessionInterface;
use App\Kernel\Validator\Validator;
use App\Kernel\Validator\ValidatorInterface;
use App\Kernel\View\View;
use App\Kernel\View\ViewInterface;

class Router implements RouterInterface
{
    private array $routes = [
        "GET" => [],
        "POST" => []
    ];

    private readonly ValidatorInterface $validator;
    private readonly RequestInterface $request;
    private readonly ViewInterface $view;
    private readonly RedirectInterface $redirect;
    private readonly SessionInterface $session;
    private readonly DatabaseInterface $db;
    private readonly AuthInterface $auth;

    public function __construct()
    {
        $this->validator = new Validator();
        $this->request = new Request();
        $this->redirect = new Redirect();
        $this->session = new Session();
        $this->db = new Database();
        $this->auth = new Auth($this->session, $this->db);
        $this->view = new View($this->session, $this->auth);
    }

    public function dispatch(): void
    {
        $method = $this->request->getMethod();
        $path = $this->request->getPath();

        if (isset($this->routes[$method][$path])) {
            [$Controller, $method] = $this->routes[$method][$path];
            $controller = new $Controller();

            call_user_func([$controller, 'setValidator'], $this->validator);
            call_user_func([$controller, 'setView'], $this->view);
            call_user_func([$controller, 'setRequest'], $this->request);
            call_user_func([$controller, 'setRedirect'], $this->redirect);
            call_user_func([$controller, 'setSession'], $this->session);
            call_user_func([$controller, 'setDB'], $this->db);
            call_user_func([$controller, 'setAuth'], $this->auth);

            call_user_func([$controller, $method]);
            return;
        }

        include_once APP_PATH . '/view/page/not-found.php';
    }

    public function get(string $path, array $handler): void
    {
        $this->addRoute($path, "GET", $handler);
    }

    public function post(string $path, array $handler): void
    {
        $this->addRoute($path, "POST", $handler);
    }

    private function addRoute(string $path, string $method, array $handler): void
    {
        $this->routes[$method][$path] = $handler;
    }

}
