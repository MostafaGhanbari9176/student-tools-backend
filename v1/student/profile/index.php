<?php
/**
 * Created by PhpStorm.
 * User: Mostafa
 * Date: 30/07/2019
 * Time: 07:58 PM
 */

require "../../../vendor/autoload.php";
require "../../uses/DBConnection.php";
require "StudentProfilePresenter.php";

use \Slim\Http\Request;
use \Slim\Http\Response;

$app = new \Slim\App();

$app->post("/addStudent", function (Request $req, Response $res) {

});

$app->post("/myProfile", function (Request $req, Response $res) {

});

$app->post("/downMyImg", function (Request $req, Response $res) {
    $data = $req->getParsedBody();
    $result = (new StudentProfilePresenter())->downMyImg($data);
    $res->getBody()->write($result);
});

$app->post("/upMyImg", function (Request $req, Response $res) {
    $data = $req->getParsedBody();
    $file = $req->getUploadedFiles();
    $result = (new StudentProfilePresenter())->upImg($data, $file);
    $res->getBody()->write($result);
});

$app->post("/friendList", function (Request $req, Response $res) {

});

$app->post("/addFriend", function (Request $req, Response $res) {

});

$app->post("/saveAboutMe", function (Request $req, Response $res) {

});

$app->post("/getAboutMe", function (Request $req, Response $res) {

});

$app->post("/eLName", function (Request $req, Response $res) {

});

$app->post("/eLPhone", function (Request $req, Response $res) {

});

$app->post("/eLImg", function (Request $req, Response $res) {

});

$app->run();