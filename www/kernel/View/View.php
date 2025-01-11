<?php

namespace App\Kernel\View;

use App\Kernel\Auth\AuthInterface;
use App\Kernel\Exceptions\ViewNotFoundException;
use App\Kernel\Session\SessionInterface;

class View implements ViewInterface
{
    public function __construct(private readonly SessionInterface $session, private readonly AuthInterface $auth)
    {
    }

    public function page(string $name, string $title): void
    {
        $viewPath = APP_PATH . "/view/page/$name.php";

        if (!file_exists($viewPath)) {
            throw new ViewNotFoundException("View $name not found");
        }

        extract($this->defaultData());

        include_once $viewPath;
    }

    public function component(string $name, array $data, bool $repeat): void {
        $componentPath = APP_PATH . "/view/component/$name.php";

        if (! file_exists($componentPath)) {
            echo "Component $name not found";

            return;
        }

        extract($this->defaultData());

        if ($repeat === true)
            include $componentPath;
        else
            include_once $componentPath;

    }

    private function defaultData(): array
    {
        return [
            "view" => $this,
            "session" => $this->session,
            "auth" => $this->auth
        ];
    }
}
