<?php
/**
 *
 * @var \App\Kernel\View\ViewInterface $view
 *
 */

$form_data = [
    [
        "title" => "Имя",
        "type" => "text",
        "name" => "name"
    ],
    [
        "title" => "Фамилия",
        "type" => "text",
        "name" => "surname"
    ],
    [
        "title" => "Отчество",
        "type" => "text",
        "name" => "patronymic"
    ],
    [
        "title" => "Email",
        "type" => "email",
        "name" => "email"
    ],
    [
        "title" => "Пароль",
        "type" => "password",
        "name" => "password"
    ]
];
?>

<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8" />
        <title>Register</title>
        <link rel="stylesheet" href="/assets/css/global.css" />
        <link rel="stylesheet" href="/assets/css/auth.css" />
    </head>

    <body class="app">
        <h1 class="title">Регистриция</h1>
        <form class="form" action="/register" method="POST">
            <?php foreach ($form_data as $data) {
                $view->component("field", $data, true);
            }?>
            <div class="form-group">
                <input checked type="radio" id="student" name="role" value="student"/>
                <label for="student">Студент</label>

                <input type="radio" id="teacher" name="role" value="teacher"/>
                <label for="teacher">Учитель</label>
            </div>
            <div class="form-group">
                <button class="button" type="submit">Регистрация</button>
            </div>
        </form>
    </body>
</html>
