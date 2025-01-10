<?php
/**
*  @var \App\Kernel\Session\SessionInterface $session
*  @var \App\Kernel\Auth\AuthInterface $auth
*/

$user = $auth->user();
?>

<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8" />
        <title>Profile</title>
        <link rel="stylesheet" href="/assets/css/style.css" />
    </head>

    <body>
        <h1>FirstName: <?=$user['firstname']?></h1>
    </body>
</html>

<?php
