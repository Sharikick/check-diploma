<?php
/**
*  @var \App\Kernel\Session\Session $session
*/
?>

<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8" />
        <title>Login</title>
        <link rel="stylesheet" href="/assets/css/style.css" />
        <link rel="stylesheet" href="/assets/css/auth.css" />
    </head>

    <body>

        <div class="page">
            <h1 class="title">Login</h1>
            <form class="form" action="/login" method="POST">
                <div class="form-group">
                    <label class="label" for="firstname">FirstName:</label>
                    <input class="input" type="text" id="firstname" name="FirstName"/>
                    <?php if ($session->has('FirstName')) { ?>
                    <ul style="color:red;">
                        <?php foreach ($session->getFlash('FirstName') as $error) { ?>
                        <li><?=$error?></li>
                        <?php }?>
                    </ul>
                    <?php } ?>
                </div>
                <div class="form-group">
                    <label class="label" for="lastname">FirstName:</label>
                    <input class="input" type="text" id="lastname" name="LastName"/>
                    <?php if ($session->has('LastName')) { ?>
                    <ul style="color:red;">
                        <?php foreach ($session->getFlash('LastName') as $error) { ?>
                        <li><?=$error?></li>
                        <?php }?>
                    </ul>
                    <?php } ?>
                </div>
                <div class="form-group">
                    <label class="label" for="password">Password:</label>
                    <input class="input" type="password" id="password" name="Password"/>
                    <?php if ($session->has('Password')) { ?>
                    <ul style="color:red;">
                        <?php foreach ($session->getFlash('Password') as $error) { ?>
                        <li><?=$error?></li>
                        <?php }?>
                    </ul>
                    <?php } ?>

                </div>
                <div>
                    <input type="radio" id="student" name="role" value="student"/>
                    <label for="student">Student</label>

                    <input type="radio" id="teacher" name="role" value="teacher"/>
                    <label for="teacher">Teacher</label>
                </div>
                <div class="form-group">
                    <button class="button" type="submit">Login</button>
                </div>
            </form>
        </div>


    </body>

</html>

<?php
