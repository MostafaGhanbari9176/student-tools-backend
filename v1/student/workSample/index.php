<?php
/**
 * Created by PhpStorm.
 * User: Mostafa
 * Date: 30/07/2019
 * Time: 07:58 PM
 */

require "../../uses/pratical.php";
require "../../../vendor/autoload.php";
require "../../uses/DBConnection.php";
require "WorkSamplePresenter.php";
require "../../uses/jdf.php";

use \Slim\Http\Request;
use \Slim\Http\Response;

$app = new \Slim\App();

$app->post("/add", function (Request $req, Response $res) {
    $data = $req->getParsedBody();
    $files = $req->getUploadedFiles();
    $result = (new WorkSamplePresenter())->add($data, $files);
    $res->getBody()->write($result);
});

$app->post("/getMyList", function (Request $req, Response $res) {
    $data = $req->getParsedBody();
    $result = (new WorkSamplePresenter())->getMyList($data);
    $res->getBody()->write($result);
});

$app->post("/getMySingle", function (Request $req, Response $res) {
    $data = $req->getParsedBody();
    $result = (new WorkSamplePresenter())->getMySingle($data);
    $res->getBody()->write($result);
});

$app->post("/getList", function (Request $req, Response $res) {
    $data = $req->getParsedBody();
    $result = (new WorkSamplePresenter())->getList($data);
    $res->getBody()->write($result);
});

$app->post("/getSingle", function (Request $req, Response $res) {
    $data = $req->getParsedBody();
    $result = (new WorkSamplePresenter())->getSingle($data);
    $res->getBody()->write($result);
});

$app->get("/img", function (Request $req, Response $res) {
    $data = $req->getQueryParams();
    $result = (new WorkSamplePresenter())->getImg($data);
    $res->getBody()->write($result);
    return $res->withHeader("Content-Type", "image/jpg");
});

$app->post("/edit", function (Request $req, Response $res) {
    $data = $req->getParsedBody();
    $files = $req->getUploadedFiles();
    $result = (new WorkSamplePresenter())->edit($data, $files);
    $res->getBody()->write($result);
});

$app->post("/delete", function (Request $req, Response $res) {
    $data = $req->getParsedBody();
    $result = (new WorkSamplePresenter())->delete($data);
    $res->getBody()->write($result);
});

$app->post("/changeLike", function (Request $req, Response $res) {
    $data = $req->getParsedBody();
    $result = (new WorkSamplePresenter())->changeLike($data);
    $res->getBody()->write($result);
});

$app->post("/seen", function (Request $req, Response $res) {
    $data = $req->getParsedBody();
    $result = (new WorkSamplePresenter())->seen($data);
    $res->getBody()->write($result);
});

$app->get("/test", function (Request $req, Response $res) {
    //echo (new WorkSamplePresenter())->test();
});

$app->run();