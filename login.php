<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 13.03.2018
 * Time: 16:30
 */
error_reporting(E_ALL);
session_start();
//include_once ('config.php');
$dsn = 'mysql:dbname=blog;host=127.0.0.1';
$user = 'root';
$password = '';

try {
    $db = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    echo 'Подключение не удалось: ' . $e->getMessage();
}

if (isset($_SESSION['auth'])) {
    unset($_SESSION['auth']);
} elseif (isset($_COOKIE['login']) || isset($_COOKIE['password'])) {
    setcookie('login', '', time() - 100, '/');
    setcookie('password', '', time() - 100, '/');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && count($_POST) > 0) {
    $user_login = trim($_POST['login']);
    $user_password = trim($_POST['password']);

    $res = $db->query("SELECT `user_id`, `user_password` FROM `blog_users` WHERE `user_login` = '{$user_login}'");
    if ($res->rowCount() == 0) {
        $error = "Такого пользователя не существует";
    } else {
        foreach ($res as $user) {
            $password = $user['user_password'];
            $user_id = $user['user_id'];
        }
        if ($user_password === $password) {
            $_SESSION['auth'] = true;
            if (isset($_POST['remember'])) {
                setcookie('login', hash('sha256', $user_id), time() + 3600 * 24, '/');
                setcookie('password', hash('sha256', $user_password), time() + 3600 * 24, '/');
            }
            if (isset($_SESSION['from'])) {
                header("Location:" . $_SESSION['from']);
                unset($_SESSION['from']);
            } else {
                header("Location: index.php");
            }
        } else {
            $error = "Вы ввели неверный пароль!";
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
<div class="error"><? echo isset($error) ? $error : ""; ?></div>
<form action="" method="post">
    <input type="text" name="login" placeholder="Ваш логин">
    <input type="password" name="password" placeholder="Ваш пароль">
    <input type="checkbox" name="remember"> Запомнить
    <button type="submit">Войти</button>
</form>
</body>
</html>

