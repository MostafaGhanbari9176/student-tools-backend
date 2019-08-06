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

$app->post("/getMessageList",function (Request $req, Response $res)
{
    $data = $req->getParsedBody();
    $result = (new ChatPresenter())->getMessageList($data);
    $res->getBody()->write($result);
});

$app->post("/getLastMessage",function (Request $req, Response $res)
{
    $data = $req->getParsedBody();
    $result = (new ChatPresenter())->getLastMessage($data);
    $res->getBody()->write($result);
});

$app->run();