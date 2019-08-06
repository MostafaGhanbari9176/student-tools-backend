<?php
/**
 * Created by PhpStorm.
 * User: Mostafa
 * Date: 30/07/2019
 * Time: 07:58 PM
 */

require "../../../vendor/autoload.php";
require "../../uses/DBConnection.php";
require "AbilityPresenter.php";
require "../../uses/jdf.php";
use Slim\Http\Request;
use Slim\Http\Response;

$app = new \Slim\App();

$app->post("/addAbility", function (Request $req, Response $res) {
    $data = $req->getParsedBody();
    $result = (new AbilityPresenter())->addAbility($data);
    $res->getBody()->write($result);
});

$app->post("/getMyList", function (Request $req, Response $res) {
    $data = $req->getParsedBody();
    $result = (new AbilityPresenter())->getMyList($data);
    $res->getBody()->write($result);
});

$app->post("/getList", function (Request $req, Response $res) {
    $data = $req->getParsedBody();
    $result = (new AbilityPresenter())->getList($data);
    $res->getBody()->write($result);
});

$app->post("/getMySingle", function (Request $req, Response $res) {
    $data = $req->getParsedBody();
    $result = (new AbilityPresenter())->getMySingle($data);
    $res->getBody()->write($result);
});

$app->post("/getSingle", function (Request $req, Response $res) {
    $data = $req->getParsedBody();
    $result = (new AbilityPresenter())->getSingle($data);
    $res->getBody()->write($result);
});

$app->post("/editAbility", function (Request $req, Response $res) {
    $data = $req->getParsedBody();
    $result = (new AbilityPresenter())->edit($data);
    $res->getBody()->write($result);
});

$app->post("/changeStatus", function (Request $req, Response $res) {
    $data = $req->getParsedBody();
    $result = (new AbilityPresenter())->changeStatus($data);
    $res->getBody()->write($result);
});

$app->post("/deleteAbility", function (Request $req, Response $res) {
    $data = $req->getParsedBody();
    $result = (new AbilityPresenter())->delete($data);
    $res->getBody()->write($result);
});

$app->run();