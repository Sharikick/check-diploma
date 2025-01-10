<?php
/**
*  @var \App\Kernel\Session\Session $session
*/
?>

<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8" />
        <title>Register</title>
        <link rel="stylesheet" href="/assets/css/style.css" />
        <link rel="stylesheet" href="/assets/css/auth.css" />
    </head>
    <body>
        <div class="page">
            <h1 class="title">Register</h1>
            <form class="form" action="/register" method="POST">
                <div class="form-group">
                    <label class="label" for="name">Имя:</label>
                    <input class="input" type="text" id="name" name="Name"/>
                    <?php if ($session->has('Name')) { ?>
                    <ul style="color:red;">
                        <?php foreach ($session->getFlash('Name') as $error) { ?>
                        <li><?=$error?></li>
                        <?php }?>
                    </ul>
                    <?php } ?>
                </div>
                <div class="form-group">
                    <label class="label" for="surname">Фамилия:</label>
                    <input class="input" type="text" id="surname" name="Surname"/>
                    <?php if ($session->has('Surname')) { ?>
                    <ul style="color:red;">
                        <?php foreach ($session->getFlash('Surname') as $error) { ?>
                        <li><?=$error?></li>
                        <?php }?>
                    </ul>
                    <?php } ?>
                </div>
                <div class="form-group">
                    <label class="label" for="patronymic">Отчество:</label>
                    <input class="input" type="text" id="patronymic" name="Patronymic"/>
                    <?php if ($session->has('Patronymic')) { ?>
                    <ul style="color:red;">
                        <?php foreach ($session->getFlash('Patronymic') as $error) { ?>
                        <li><?=$error?></li>
                        <?php }?>
                    </ul>
                    <?php } ?>
                </div>
                <div class="form-group">
                    <label class="label" for="email">Email:</label>
                    <input class="input" type="email" id="email" name="Email"/>
                    <?php if ($session->has('Email')) { ?>
                    <ul style="color:red;">
                        <?php foreach ($session->getFlash('Email') as $error) { ?>
                        <li><?=$error?></li>
                        <?php }?>
                    </ul>
                    <?php } ?>
                </div>
                <div class="form-group">
                    <label class="label" for="password">Пароль:</label>
                    <input class="input" type="password" id="password" name="Password"/>
                    <?php if ($session->has('Password')) { ?>
                    <ul style="color:red;">
                        <?php foreach ($session->getFlash('Password') as $error) { ?>
                        <li><?=$error?></li>
                        <?php }?>
                    </ul>
                    <?php } ?>

                </div>
                <div class="form-group">
                    <input type="radio" id="student" name="role" value="student"/>
                    <label for="student">Student</label>

                    <input type="radio" id="teacher" name="role" value="teacher"/>
                    <label for="teacher">Teacher</label>
                </div>
                <div class="form-group">
                    <button class="button" type="submit">Register</button>
                </div>
            </form>
        </div>
    </body>

</html>

<?php
