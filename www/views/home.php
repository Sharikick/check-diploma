<?php
/**
*  @var \App\Kernel\Session\SessionInterface $session
*  @var \App\Kernel\Auth\AuthInterface $auth
*/
?>

<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8" />
        <title>Home</title>
        <link rel="stylesheet" href="/assets/css/style.css" />
    </head>

    <body>
        <header class="header">
            <button class="btn" id="login">Авторизация</button>
            <button class="btn" id="register">Регистрация</button>
            <button class="btn" onclick="window.location.href = '/profile'">Профиль</button>
            <form action="/logout" method="POST">
                <button type="submit" class="btn">Выйти</button>
            </form>
        </header>
        <h1>Home Page</h1>

    </body>

    <script>
        document.getElementById('login').addEventListener('click', () => {
            window.location.href = '/login';
        });

        document.getElementById('register').addEventListener('click', () => {
            window.location.href = '/register';
        });
    </script>

</html>

<?php
