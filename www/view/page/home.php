<?php
/**
* @var \App\Kernel\View\ViewInterface $view
* @var \App\Kernel\Session\SessionInterface $session
* @var \App\Kernel\Auth\AuthInterface $auth
*/
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?=$title?></title>
        <link rel="stylesheet" href="/assets/css/global.css" />
        <link rel="stylesheet" href="/assets/css/home.css" />
    </head>
    <body class="app">
        <header class="header">
            <nav class="nav">
                <a href="/" class="link">Главная страница</a>
                <a href="/check" class="link">Проверка диплома</a>
                <a href="/report" class="link">Отчеты</a>
                <a href="/login" class="link">Авторизация</a>
                <a href="/register" class="link">Регистрация</a>
                <a href="/profile" class="link">Профиль</a>
            </nav>
        </header>
        <main class="main">
            Main
        </main>
        <footer class="footer">
            Footer
        </footer>
    </body>
</html>
