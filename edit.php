<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 13.03.2018
 * Time: 10:37
 */
error_reporting(E_ALL);
require_once("functions.php");
require_once("config.php");

session_start();

if (!is_authorised($login, $password)) {
    header("Location: login.php");
    $_SESSION['from'] = $_SERVER['REQUEST_URI'];
    exit ();
}

$title = $_GET['fname'] ?? null;


if ($title == null) {
    $msg = "Ошибка! Не передано название статьи!";
    $title = '';
    $content = '';
} elseif (!validate_title($title)) {
    $msg = "Ошибка 404. Нет такой статьи!";
    $title = '';
    $content = '';
} elseif (!file_exists('data/' . $title)) {
    $msg = 'Ошибка 404. Нет такой статьи!';
    $title = '';
    $content = '';
} else {
    $content = file_get_contents('data/' . $title);
    $msg = "";

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && count($_POST) > 0) {
        $new_title = trim($_POST['title']);
        $new_content = trim($_POST['content']);

        if ($new_title === $title && $new_content === $content) {
            $msg = "Вы не внесли изменений!";
        } elseif ($new_title == '' || $new_content == '') {
            $msg = 'Заполните все поля';
        } elseif (!validate_title($new_title)) {
            $msg = "Тайтл должен содержать только цифры, латиницу, тире и символы подчеркивания!";
        } elseif ($new_title != $title && file_exists("data/" . $new_title)) {
            $msg = "Тайтл уже занят!";
            $title = $new_title;
            $content = $new_content;
        } else {
            if ($title != $new_title) {
                unlink("data/" . $title);
            }
            file_put_contents("data/" . $new_title, $new_content);
            header("Location: index.php");
            exit();
        }
    }
}
?>
    <!doctype html>
    <html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <style>
            input, textarea {
                display: block;
                margin-bottom: 10px;
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
        Название<br>
        <input type="text" name="title" value="<?= $title ?>">
        Контент<br>
        <textarea name="content" cols="150" rows="20"><?= $content ?></textarea>
        <input type="submit" value="Внести изменения">
    </form>
    </body>
    </html>

<?php echo "<div class='error'>$msg</div>"; ?>