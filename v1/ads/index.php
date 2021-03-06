<?php
/**
 * Created by PhpStorm.
 * User: Mostafa
 * Date: 14/09/2019
 * Time: 04:57 PM
 */

use Slim\Http\Request;
use Slim\Http\Response;

require "../../vendor/autoload.php";
require "../uses/jdf.php";
require "../uses/DBConnection.php";
require "AdsPresenter.php";

$app = new \Slim\App();

$app->post('/getFirstData', function (Request $req, Response $res){

    $data = $req->getParsedBody();
    $result = (new AdsPresenter())->getFirstData($data);
    $res->getBody()->write($result);

});

$app->post('/get', function (Request $req, Response $res){

    $data = $req->getParsedBody();
    $result = (new AdsPresenter())->get($data);
    $res->getBody()->write($result);

});

$app->post('/getSpecial', function (Request $req, Response $res){

    $data = $req->getParsedBody();
    $result = (new AdsPresenter())->getSpecial($data);
    $res->getBody()->write($result);

});

$app->post('/getListData', function (Request $req, Response $res){

    $data = $req->getParsedBody();
    $result = (new AdsPresenter())->getListData($data);
    $res->getBody()->write($result);

});

$app->run();