<?php
session_start();
include_once 'config.php';
$res = $db->query("SELECT `post_id`, `post_title` FROM `blog_posts` WHERE 1", PDO::FETCH_ASSOC);
foreach ($res as $post) {
    echo "<a href=post.php?id={$post['post_id']}>{$post['post_title']}</a><br>";
}
?>
<a href="add.php">Добавить</a>
<a href="add.php">Добавить</a>
<a href="add.php">Добавить</a>