<?php
/**
 * Created by PhpStorm.
 * User: Mostafa
 * Date: 30/07/2019
 * Time: 07:18 AM
 */

require '../../vendor/autoload.php';
require "../uses/DBConnection.php";
require "UserPresenter.php";
require "../uses/jdf.php";

use Slim\Http\Request;
use Slim\Http\Response;

$app = new \Slim\App();

$app->post("/sendVerifyCode", function (Request $req, Response $res) {
    $data = $req->getParsedBody();
    $result = (new UserPresenter())->sendVerifyCode($data);
    $res->getBody()->write($result);
});

$app->post("/checkVerifyCode", function (Request $req, Response $res) {
    $data = $req->getParsedBody();
    $result = (new UserPresenter())->checkVerifyCode($data);
    $res->getBody()->write($result);
});

$app->post("/logIn", function (Request $req, Response $res) {
    $data = $req->getParsedBody();
    $result = (new UserPresenter())->logIn($data);
    $res->getBody()->write($result);
});

$app->post("/newPass", function (Request $req, Response $res) {
    $data = $req->getParsedBody();
    $result = (new UserPresenter())->newPass($data);
    $res->getBody()->write($result);
});

$app->post("/logOut", function (Request $req, Response $res) {
    $data = $req->getParsedBody();
    $result = (new UserPresenter())->logOut($data);
    $res->getBody()->write($result);
});

$app->run();