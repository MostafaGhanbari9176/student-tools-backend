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
require "presenter/StudentPresenter.php";

$app = new \Slim\App();

$app->get("/addStudent/{phone}/{sId}/{name}",function (Request $req, Response $res){
    $p = $req->getAttribute("phone");
    $s = $req->getAttribute("sId");
    $n = $req->getAttribute("name");
    (new StudentPresenter())->addStudent($p, $s, $n);
    $res->getBody()->write("ok");
});

$app->post("/addStudent",function (Request $req, Response $res){

    $data = $req->getParsedBody();

    $p = $data['phone'];
    $s = $data['sId'];
    $n = $data['name'];

    (new StudentPresenter())->addStudent($p, $s, $n);
    $res->getBody()->write("ok");
});

$app->run();