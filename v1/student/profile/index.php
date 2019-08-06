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
require "../../uses/jdf.php";

use \Slim\Http\Request;
use \Slim\Http\Response;

$app = new \Slim\App();

$app->post("/addStudent", function (Request $req, Response $res) {
    $data = $req->getParsedBody();
    $result = (new StudentProfilePresenter())->add($data);
    $res->getBody()->write($result);
});

$app->post("/myProfile", function (Request $req, Response $res) {
    $data = $req->getParsedBody();
    $result = (new StudentProfilePresenter())->getMyData($data);
    $res->getBody()->write($result);
});

$app->post("/getProfile", function (Request $req, Response $res) {
    $data = $req->getParsedBody();
    $result = (new StudentProfilePresenter())->getProfile($data);
    $res->getBody()->write($result);
});

$app->post("/downMyImg", function (Request $req, Response $res) {
    $data = $req->getParsedBody();
    $result = (new StudentProfilePresenter())->downMyImg($data);
    $res->getBody()->write($result);
});

$app->post("/downImg", function (Request $req, Response $res) {
    $data = $req->getParsedBody();
    $result = (new StudentProfilePresenter())->downImg($data);
    $res->getBody()->write($result);
});

$app->post("/upMyImg", function (Request $req, Response $res) {
    $data = $req->getParsedBody();
    $file = $req->getUploadedFiles();
    $result = (new StudentProfilePresenter())->upImg($data, $file);
    $res->getBody()->write($result);
});

$app->post("/friendList", function (Request $req, Response $res) {
    $data = $req->getParsedBody();
    $result = (new StudentProfilePresenter())->getFriendList($data);
    $res->getBody()->write($result);
});

$app->post("/chatList", function (Request $req, Response $res) {
    $data = $req->getParsedBody();
    $result = (new StudentProfilePresenter())->getChatList($data);
    $res->getBody()->write($result);
});

$app->post("/addFriend", function (Request $req, Response $res) {
    $data = $req->getParsedBody();
    $result = (new StudentProfilePresenter())->addFriend($data);
    $res->getBody()->write($result);
});

$app->post("/saveAboutMe", function (Request $req, Response $res) {
    $data = $req->getParsedBody();
    $result = (new StudentProfilePresenter())->saveAboutMe($data);
    $res->getBody()->write($result);
});

$app->post("/getAboutMe", function (Request $req, Response $res) {
    $data = $req->getParsedBody();
    $result = (new StudentProfilePresenter())->aboutMe($data);
    $res->getBody()->write($result);
});

$app->post("/eLName", function (Request $req, Response $res) {
    $data = $req->getParsedBody();
    $result = (new StudentProfilePresenter())->elName($data);
    $res->getBody()->write($result);
});

$app->post("/eLPhone", function (Request $req, Response $res) {
    $data = $req->getParsedBody();
    $result = (new StudentProfilePresenter())->eLPhone($data);
    $res->getBody()->write($result);
});

$app->post("/eLImg", function (Request $req, Response $res) {
    $data = $req->getParsedBody();
    $result = (new StudentProfilePresenter())->eLImg($data);
    $res->getBody()->write($result);
});

$app->post("/searchStudentById", function (Request $req, Response $res) {
    $data = $req->getParsedBody();
    $result = (new StudentProfilePresenter())->searchBySId($data);
    $res->getBody()->write($result);
});

$app->run();

