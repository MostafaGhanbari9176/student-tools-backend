<?php
/**
 * Created by PhpStorm.
 * User: Mostafa
 * Date: 27/08/2019
 * Time: 03:30 PM
 */

require "../uses/pratical.php";
require "../../vendor/autoload.php";
require "../uses/DBConnection.php";
require "BlogPresenter.php";
require "../uses/jdf.php";

use \Slim\Http\Request;
use \Slim\Http\Response;

$app = new \Slim\App();

$app->post("/add", function (Request $req, Response $res) {
    $data = $req->getParsedBody();
    $result = (new BlogPresenter())->add($data);
    $res->getBody()->write($result);
});

$app->get("/img", function (Request $req, Response $res) {
    $data = $req->getQueryParams();
    $result = (new BlogPresenter())->getImg($data);
    $res->getBody()->write($result);
    return $res->withHeader("Content-Type", "image/jpg");
});

$app->post("/addWImg", function (Request $req, Response $res) {
    $data = $req->getParsedBody();
    $file = $req->getUploadedFiles();
    $result = (new BlogPresenter())->addWithImg($data, $file);
    $res->getBody()->write($result);
});

$app->post("/getPerLike", function (Request $req, Response $res) {
    $data = $req->getParsedBody();
    $result = (new BlogPresenter())->getPerLike($data);
    $res->getBody()->write($result);
});

$app->post("/getAll", function (Request $req, Response $res) {
    $data = $req->getParsedBody();
    $result = (new BlogPresenter())->getAll($data);
    $res->getBody()->write($result);
});

$app->post("/changeLike", function (Request $req, Response $res) {
    $data = $req->getParsedBody();
    $result = (new BlogPresenter())->changeLike($data);
    $res->getBody()->write($result);
});

$app->post("/report", function (Request $req, Response $res) {
    $data = $req->getParsedBody();
    $result = (new BlogPresenter())->report($data);
    $res->getBody()->write($result);
});

$app->run();