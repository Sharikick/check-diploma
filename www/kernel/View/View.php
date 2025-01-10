<?php

namespace App\Kernel\View;

use App\Kernel\Auth\AuthInterface;
use App\Kernel\Exceptions\ViewNotFoundException;
use App\Kernel\Session\SessionInterface;

class View implements ViewInterface
{
    public readonly SessionInterface $session;
    public readonly AuthInterface $auth;

    public function __construct(SessionInterface $session, AuthInterface $auth)
    {
        $this->session = $session;
        $this->auth = $auth;
    }

    public function page(string $name): void
    {
        $viewPath = APP_PATH . "/views/$name.php";

        if (!file_exists($viewPath)) {
            throw new ViewNotFoundException("View $name not found");
        }

        extract($this->defaultData());

        include_once $viewPath;
    }

    private function defaultData(): array
    {
        return [
            "session" => $this->session,
            "auth" => $this->auth
        ];
    }
}
