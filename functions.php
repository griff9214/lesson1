<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 12.03.2018
 * Time: 18:21
 */
function validate_title($title)
{
    return preg_match("#[a-zA-Z0-9\-_]{" . mb_strlen($title) . "}#is", $title);
}
function is_authorised($login, $password){
    if (!((isset($_SESSION['auth']) && $_SESSION['auth'] == true) || (($_COOKIE['login'] ?? null) === hash('sha256', $login) && ($_COOKIE['password'] ?? null) === hash('sha256', $password)))){
        return false;
    }
    return true;
}
