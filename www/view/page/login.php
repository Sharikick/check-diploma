<?php
/**
 *
 * @var \App\Kernel\View\ViewInterface $view
 *
 */

$form_data = [
    [
        "Title" => "Email",
        "Type" => "email",
        "Name" => "Email"
    ],
    [
        "Title" => "Пароль",
        "Type" => "password",
        "Name" => "Password"
    ]
];
?>

<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8" />
        <title>Авторизация</title>
        <link rel="stylesheet" href="/assets/css/global.css" />
        <link rel="stylesheet" href="/assets/css/auth.css" />
    </head>

    <body class="app">
        <h1 class="title">Авторизация</h1>
        <form class="form" action="/login" method="POST">
            <?php foreach ($form_data as $data) {
                $view->component("field", $data, true);
            }?>
            <div class="form-group">
                <button class="button" type="submit">Авторизация</button>
            </div>
        </form>
    </body>
</html>
