<?php
error_reporting(E_ALL);

include_once("functions.php");
include_once("config.php");

session_start();

//if (!is_authorised($login, $password)) {
//    header("Location: login.php");
//    $_SESSION['from'] = $_SERVER['REQUEST_URI'];
//    exit ();
//}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $query = "INSERT INTO `blog_posts` (`post_id`, `post_title`, `post_content`, `post_author_id`) VALUES (NULL, '{$title}', '{$content}', '1');";

    if ($title == '' || $content == '') {
        $msg = 'Заполните все поля';
    } elseif (!validate_title($title)) {
        $msg = "Тайтл должен содержать только цифры, латиницу, тире и символы подчеркивания!";
    } elseif (file_exists("data/" . $title)) {
        $msg = "Тайтл уже занят!";
    } else {
        //file_put_contents("data/" . $title, $content);
        $db->query($query);
        header("Location: index.php");
        exit();
    }
} else {
    $msg = '';
    $title = '';
    $content = '';
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
        <textarea name="content"><?= $content ?></textarea>
        <input type="submit" value="Добавить">
    </form>
    </body>
    </html>

<?php echo "<div class='error'>$msg</div>"; ?>