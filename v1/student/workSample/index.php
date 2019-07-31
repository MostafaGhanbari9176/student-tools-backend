<?php
/**
 * Created by PhpStorm.
 * User: Mostafa
 * Date: 30/07/2019
 * Time: 07:58 PM
 */

require "../../../vendor/autoload.php";
require "../../uses/DBConnection.php";
require "WorkSamplePresenter.php";
require "../../uses/jdf.php";

use \Slim\Http\Request;
use \Slim\Http\Response;

$app = new \Slim\App();

$app->post("/add", function (Request $req, Response $res){
    $data = $req->getParsedBody();
    $result = (new WorkSamplePresenter())->add($data);
    $res->getBody()->write($result);
});

$app->post("/getList", function (Request $req, Response $res){

});

$app->post("/getSingle", function (Request $req, Response $res){

});

$app->post("/edit", function (Request $req, Response $res){

});

$app->post("/changeStatus", function (Request $req, Response $res){

});

$app->post("/delete", function (Request $req, Response $res){

});

$app->run();