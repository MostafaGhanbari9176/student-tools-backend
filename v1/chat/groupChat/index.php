<?php
/**
 * Created by PhpStorm.
 * User: Mostafa
 * Date: 02/09/2019
 * Time: 03:43 PM
 */

require "../../../vendor/autoload.php";
require "../../uses/DBConnection.php";
require "GroupChatPresenter.php";
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

$app->post("/create",function (Request $req, Response $res)
{
    $data = $req->getParsedBody();
    $result = (new GroupChatPresenter())->create($data);
    $res->getBody()->write($result);
});

$app->post("/get",function (Request $req, Response $res)
{
    $data = $req->getParsedBody();
    $result = (new GroupChatPresenter())->get($data);
    $res->getBody()->write($result);
    return $res->withHeader('Content-Type', 'image/png');
});

$app->get('/downImg',function(Request $req, Response $res){

    $data = $req->getQueryParams();
    $result =(new GroupChatPresenter())->getImg($data);
    $res->getBody()->write($result);

});

$app->post('/memberList',function(Request $req, Response $res){

    $data = $req->getParsedBody();
    $result =(new GroupChatPresenter())->memberList($data);
    $res->getBody()->write($result);

});

$app->post('/left', function(Request $req, Response $res){
    $data = $req->getParsedBody();
    $result = (new GroupChatPresenter())->left($data);
    $res->getBody()->write($result);
});

$app->post('/removeMember', function(Request $req, Response $res){
    $data = $req->getParsedBody();
    $result = (new GroupChatPresenter())->deleteMember($data);
    $res->getBody()->write($result);
});

$app->post('/upImg', function(Request $req, Response $res){
    $data = $req->getParsedBody();
    $file = $req->getUploadedFiles();
    $result = (new GroupChatPresenter())->uploadImage($data, $file);
    $res->getBody()->write($result);
});


$app->run();