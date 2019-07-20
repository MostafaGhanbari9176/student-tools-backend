<?php
/**
 * Created by PhpStorm.
 * User: Mostafa
 * Date: 20/07/2019
 * Time: 08:59 PM
 */

require '../vendor/autoload.php';
use Slim\Http\Request;
use Slim\Http\Response;
require "presenter/UserPresenter.php";

$app = new \Slim\App();

$app->get("/studentLogUp/{phone}/{sId}/{name}", function (Request $req, Response $res){

    $p = $req->getAttribute("phone");
    $s = $req->getAttribute("sId");
    $n = $req->getAttribute("name");
    (new UserPresenter())->addUser($p, $s, $n);

});

$app->run();