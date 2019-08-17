<?php
/**
 * Created by PhpStorm.
 * User: Mostafa
 * Date: 06/08/2019
 * Time: 04:58 PM
 */


require "../../../vendor/autoload.php";
require "../../uses/DBConnection.php";
require "ChatPresenter.php";
require "../../uses/jdf.php";

use \Slim\Http\Request;
use \Slim\Http\Response;

$app = new \Slim\App();

$app->post("/sendMessage",function (Request $req, Response $res)
{
    $data = $req->getParsedBody();
    $result = (new ChatPresenter())->sendMessage($data);
    $res->getBody()->write($result);
});

$app->post("/sendFileMessage",function (Request $req, Response $res)
{
    $data = $req->getParsedBody();
    $file = $req->getUploadedFiles();
    $result = (new ChatPresenter())->sendFileMessage($data, $file);
    $res->getBody()->write($result);
});

$app->post("/getLastMessage",function (Request $req, Response $res)
{
    $data = $req->getParsedBody();
    $result = (new ChatPresenter())->getLastMessage($data);
    $res->getBody()->write($result);
});

$app->post("/getOldMessage",function (Request $req, Response $res)
{
    $data = $req->getParsedBody();
    $result = (new ChatPresenter())->getOldMessage($data);
    $res->getBody()->write($result);
});

$app->post("/getNewMessage",function (Request $req, Response $res)
{
    $data = $req->getParsedBody();
    $result = (new ChatPresenter())->getNewMessage($data);
    $res->getBody()->write($result);
});

$app->post("/seen",function (Request $req, Response $res)
{
    $data = $req->getParsedBody();
    $result = (new ChatPresenter())->seen($data);
    $res->getBody()->write($result);
});

$app->run();