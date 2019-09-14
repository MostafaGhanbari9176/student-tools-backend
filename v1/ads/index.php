<?php
/**
 * Created by PhpStorm.
 * User: Mostafa
 * Date: 14/09/2019
 * Time: 04:57 PM
 */

require "../../vendor/autoload.php";
require "../uses/jdf.php";
require "../uses/DBConnection.php";

$app = new \Slim\App();

$app->post('/getGroupList', function ($req, $res){


});

$app->run();