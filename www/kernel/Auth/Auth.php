<?php

namespace App\Kernel\Auth;

use App\Kernel\Database\DatabaseInterface;
use App\Kernel\Session\SessionInterface;

class Auth implements AuthInterface
{
    private SessionInterface $session;
    private DatabaseInterface $db;

    public function __construct(SessionInterface $session, DatabaseInterface $db)
    {
        $this->db = $db;
        $this->session = $session;
    }
}
