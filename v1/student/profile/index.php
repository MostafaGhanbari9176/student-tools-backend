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

$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];
$c = new \Slim\Container($configuration);
$app = new \Slim\App($c);

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

$app->get("/downMyImg", function (Request $req, Response $res) {
    $data = $req->getQueryParams();
    $result = (new StudentProfilePresenter())->downMyImg($data);
    $res->getBody()->write($result);
    return $res->withHeader("Content-Type","image/jpeg");
});

$app->get("/downImg", function (Request $req, Response $res) {
    $data = $req->getQueryParams();
    $result = (new StudentProfilePresenter())->downImg($data);
    $res->getBody()->write($result);
    return $res->withHeader('Content-Type', 'image/jpeg');
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

$app->post("/deleteFriend", function (Request $req, Response $res) {
    $data = $req->getParsedBody();
    $result = (new StudentProfilePresenter())->deleteFriend($data);
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

$app->post("/online", function (Request $req, Response $res) {
    $data = $req->getParsedBody();
    $result = (new StudentProfilePresenter())->changeOnline($data, 1);
    $res->getBody()->write($result);
});

$app->post("/offline", function (Request $req, Response $res) {
    $data = $req->getParsedBody();
    $result = (new StudentProfilePresenter())->changeOnline($data, 0);
    $res->getBody()->write($result);
});

$app->post("/lastSeen", function (Request $req, Response $res) {
    $data = $req->getParsedBody();
    $result = (new StudentProfilePresenter())->getLastSeen($data);
    $res->getBody()->write($result);
});

$app->post("/itsFriend", function (Request $req, Response $res) {
    $data = $req->getParsedBody();
    $result = (new StudentProfilePresenter())->itsFriend($data);
    $res->getBody()->write($result);
});

$app->get("/test", function (Request $req, Response $res) {
var_dump($req->getQueryParams());
});

$app->run();

