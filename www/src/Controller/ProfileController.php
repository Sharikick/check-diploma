<?php

namespace App\Controller;

use App\Kernel\Controller\Controller;

class ProfileController extends Controller
{
    public function index()
    {
        parent::view('profile');
    }
}
