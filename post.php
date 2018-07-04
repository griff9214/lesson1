<?php
include_once("config.php");
$post_id = $_GET['id'] ?? null;

if ($post_id === null) {
    echo 'Ошибка 404, не передано название';
} else {
    $res = $db->query("SELECT `post_content` FROM `blog_posts` WHERE `post_id` = $post_id");
    if ($res->rowCount() == 0) {
        echo "Нет такой статьи!";
    } else {
        $row = $res->fetch(PDO::FETCH_ASSOC);
        echo nl2br($row['post_content']);

        echo "<br><br><a href='edit.php?id=" . $post_id . "'>Edit article</a>";
    }

}

////