<?php

if (count($_POST) > 0) {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);

    if ($title == '' || $content == '') {
        $msg = 'Заполните все поля';
    } /*
			проверка корректности title
			проверка уникальности title
		*/
    else {
        // сохранить статью в файл
        header("Location: index.php");
        exit();
    }
} else {
    $msg = '';
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
    </head>
    <body>
    <form method="post">
        Название<br>
        <input type="text" name="title">
        Контент<br>
        <textarea name="content"></textarea>
        <input type="submit" value="Добавить">
    </form>
    </body>
    </html>

<?php echo $msg; ?>