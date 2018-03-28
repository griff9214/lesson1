<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 22.03.2018
 * Time: 10:06
 *
 * /* Подключение к базе данных MySQL с помощью вызова драйвера */

$res = $dbh->query("SELECT * FROM `blog_users`");

foreach ($res as $str) {
    echo $str[0] . "\t";
    echo $str[1] . "\t";
    echo $str[2] . "\t";
    echo $str[3] . "<br>";
    
}
