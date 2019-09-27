<?php
/**
 * Created by PhpStorm.
 * User: Mostafa
 * Date: 15/09/2019
 * Time: 02:41 AM
 */

use Slim\Http\Request;
use Slim\Http\Response;

require "../../vendor/autoload.php";
require "../uses/jdf.php";
require "../uses/DBConnection.php";
require "NewsPresenter.php";

$c = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];
$app = new \Slim\App($c);

$app->post('/getFirstData', function (Request $req, Response $res){

    $data = $req->getParsedBody();
    $result = (new NewsPresenter())->getFirstData($data);
    $res->getBody()->write($result);

});

$app->post('/get', function (Request $req, Response $res){

    $data = $req->getParsedBody();
    $result = (new NewsPresenter())->get($data);
    $res->getBody()->write($result);

});

$app->post('/getSpecial', function (Request $req, Response $res){

    $data = $req->getParsedBody();
    $result = (new NewsPresenter())->getSpecial($data);
    $res->getBody()->write($result);

});

$app->post('/getListData', function (Request $req, Response $res){

    $data = $req->getParsedBody();
    $result = (new NewsPresenter())->getListData($data);
    $res->getBody()->write($result);

});

$app->get('/getImg', function (Request $req, Response $res){

    $data = $req->getQueryParams();
    $result = (new NewsPresenter())->getImg($data);
    $res->getBody()->write($result);
    return $res->withHeader("Content-Type","image/jpg");

});

$app->run();