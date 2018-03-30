<?php
session_start();
include_once 'config.php';
include_once 'functions.php';
$sql = "SELECT `post_id`, `post_title` FROM `blog_posts` ORDER BY `post_date` DESC";
$res = $db_query($sql);
while ($post = $res->fetch(PDO::FETCH_ASSOC)) {
    echo "<a href=post.php?id={$post['post_id']}>{$post['post_title']}</a><br>";
}
?>
<a href="add.php">Добавить</a>
<a href="add.php">Добавить</a>
<a href="add.php">Добавить</a>