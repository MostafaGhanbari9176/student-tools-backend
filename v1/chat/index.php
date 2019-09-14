<?php
/**
 * Created by PhpStorm.
 * User: Mostafa
 * Date: 06/08/2019
 * Time: 04:58 PM
 */


require "../../vendor/autoload.php";
require "../uses/DBConnection.php";
require "ChatPresenter.php";
require "groupChat/GroupChatPresenter.php";
require "../uses/jdf.php";

use \Slim\Http\Request;
use \Slim\Http\Response;

$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];
$c = new \Slim\Container($configuration);

$app = new \Slim\App($c);

$app->post("/sendMessage", function (Request $req, Response $res) {
    $data = $req->getParsedBody();
    if ($data['kindId'] === "s")
        $result = (new ChatPresenter())->sendMessage($data);
    else
        $result = (new GroupChatPresenter())->sendMessage($data);
    $res->getBody()->write($result);
});

$app->post("/sendFileMessage", function (Request $req, Response $res) {
    $data = $req->getParsedBody();
    $file = $req->getUploadedFiles();
    if ($data['kindId'] === "s")
        $result = (new ChatPresenter())->sendFileMessage($data, $file);
    else
        $result = (new GroupChatPresenter())->sendFileMessage($data, $file);
    $res->getBody()->write($result);
});

$app->post("/getLastMessage", function (Request $req, Response $res) {
    $data = $req->getParsedBody();
    if ($data['kindId'] === "s")
        $result = (new ChatPresenter())->getLastMessage($data);
    else
        $result = (new GroupChatPresenter())->getLastMessage($data);
    $res->getBody()->write($result);
});

$app->post("/getOldMessage", function (Request $req, Response $res) {
    $data = $req->getParsedBody();
    if ($data['kindId'] === "s")
        $result = (new ChatPresenter())->getOldMessage($data);
    else
        $result = (new GroupChatPresenter())->getOldMessage($data);
    $res->getBody()->write($result);
});

$app->post("/getNewMessage", function (Request $req, Response $res) {
    $data = $req->getParsedBody();
    if ($data['kindId'] === "s")
        $result = (new ChatPresenter())->getNewMessage($data);
    else
        $result = (new GroupChatPresenter())->getNewMessage($data);
    $res->getBody()->write($result);
});

$app->post("/seen", function (Request $req, Response $res) {
    $data = $req->getParsedBody();
    $result = (new ChatPresenter())->seen($data);
    $res->getBody()->write($result);
});

$app->run();