<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 13.03.2018
 * Time: 16:30
 */
session_start();
require_once('config.php');

if (isset($_SESSION['auth'])) {
    unset($_SESSION['auth']);
} elseif (isset($_COOKIE['login']) || isset($_COOKIE['password'])) {
    setcookie('login', '', time() - 100, '/');
    setcookie('password', '', time() - 100, '/');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && count($_POST) > 0) {
    $user_login = trim($_POST['login']);
    $user_password = trim($_POST['password']);
    if ($user_login === $login && $user_password === $password) {
        $_SESSION['auth'] = true;
        if (isset($_POST['remember'])) {
            setcookie('login', hash('sha256', $user_login), time() + 3600 * 24, '/');
            setcookie('password', hash('sha256', $user_password), time() + 3600 * 24, '/');
        }
        if (isset($_SESSION['from'])) {
            header("Location:" . $_SESSION['from']);
            unset($_SESSION['from']);
        } else {
            header("Location: index.php");
        }
    }
}


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        input, textarea, button {
            display: block;
            margin-bottom: 10px;
        }

        input[type=checkbox] {
            display: inline-block;
        }

        .error {
            display: block;
            color: red;
            margin-bottom: 10px;
        }
    </style>

</head>
<body>
<form action="" method="post">
    <input type="text" name="login" placeholder="Ваш логин">
    <input type="password" name="password" placeholder="Ваш пароль">
    <input type="checkbox" name="remember"> Запомнить
    <button type="submit">Войти</button>
</form>
</body>
</html>

