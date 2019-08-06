<?php
/**
 * Created by PhpStorm.
 * User: Mostafa
 * Date: 07/08/2019
 * Time: 01:59 AM
 */

$error = 200;
$ok = 100;
$acError = 400;
$badReq = 300;

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}