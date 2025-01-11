<?php

namespace App\Kernel\Auth;

use App\Kernel\Database\DatabaseInterface;
use App\Kernel\Session\SessionInterface;

class Auth implements AuthInterface
{
    public function __construct(
        private readonly SessionInterface $session,
        private readonly DatabaseInterface $db
    ) {
    }

    public function attempt(): void
    {

    }

    public function check(): bool
    {
        return $this->session->has($this->session->get("user_id"));
    }
}
