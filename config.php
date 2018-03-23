<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 13.03.2018
 * Time: 17:03
 */

$dsn = 'mysql:dbname=blog;host=127.0.0.1';
$user = 'root';
$password = '';

try {
    $db = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    echo 'Подключение не удалось: ' . $e->getMessage();
}
