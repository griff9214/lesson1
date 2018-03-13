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
