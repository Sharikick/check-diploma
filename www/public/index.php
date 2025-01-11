<?php

use App\Controller\AuthController;
use App\Controller\HomeController;
use App\Controller\ProfileController;
use App\Controller\ReportController;
use App\Kernel\Router\Router;

define('APP_PATH', dirname(__DIR__));

require_once APP_PATH . '/vendor/autoload.php';

$router = new Router();

$router->get('/', [HomeController::class, 'index']);
$router->get('/login', [AuthController::class, 'loginPage']);
$router->get('/register', [AuthController::class, 'registerPage']);
$router->get('/profile', [ProfileController::class, 'index']);
$router->get('/check', [ReportController::class, 'checkPage']);
$router->get('/report', [ReportController::class, 'reportPage']);

$router->post('/register', [AuthController::class, 'register']);

$router->dispatch();
