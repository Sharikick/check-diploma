<?php

namespace App\Kernel\Router;

use App\Kernel\Database\DatabaseInterface;
use App\Kernel\Http\Method;
use App\Kernel\Http\RedirectInterface;
use App\Kernel\Http\RequestInterface;
use App\Kernel\Session\SessionInterface;
use App\Kernel\View\ViewInterface;

class Router implements RouterInterface
{
    private array $routes;
    private RequestInterface $request;
    private ViewInterface $view;
    private RedirectInterface $redirect;
    private SessionInterface $session;
    private DatabaseInterface $database;

    public function __construct(
        RequestInterface $request,
        ViewInterface $view,
        RedirectInterface $redirect,
        SessionInterface $session,
        DatabaseInterface $database,
    ) {
        $this->routes = $this->ininializationRoutes();
        $this->request = $request;
        $this->view = $view;
        $this->redirect = $redirect;
        $this->session = $session;
        $this->database = $database;
    }

    private function ininializationRoutes(): array
    {
        return [
            Method::GET->value => [],
            Method::POST->value => [],
            Method::PUT->value => [],
            Method::DELETE->value => []
        ];
    }

    public function dispatch(Method $method, string $path): void
    {
        if (isset($this->routes[$method->value][$path])) {
            $handler = $this->routes[$method->value][$path];
            if (is_callable($handler)) {
                call_user_func($handler);
                return;
            } else {
                [$controller, $method] = $handler;

                $controller = new $controller();
                call_user_func([$controller, 'setView'], $this->view);
                call_user_func([$controller, 'setRequest'], $this->request);
                call_user_func([$controller, 'setRedirect'], $this->redirect);
                call_user_func([$controller, 'setSession'], $this->session);
                call_user_func([$controller, 'setDatabase'], $this->database);

                call_user_func([$controller, $method]);
                return;
            }
        }

        include_once APP_PATH . '/views/not-found.php';
    }

    public function get(string $path, callable | array $handler): void
    {
        $this->addRoute($path, Method::GET, $handler);
    }

    public function post(string $path, callable | array $handler): void
    {
        $this->addRoute($path, Method::POST, $handler);
    }

    public function put(string $path, callable | array $handler): void
    {
        $this->addRoute($path, Method::PUT, $handler);
    }

    public function delete(string $path, callable | array $handler): void
    {
        $this->addRoute($path, Method::DELETE, $handler);
    }

    private function addRoute(string $path, Method $method, callable | array $handler): void
    {
        $this->routes[$method->value][$path] = $handler;
    }

}
