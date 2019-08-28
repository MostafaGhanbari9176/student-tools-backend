<?php
/**
 * Created by PhpStorm.
 * User: Mostafa
 * Date: 15/08/2019
 * Time: 10:58 PM
 */

require "../../vendor/autoload.php";
require "../uses/DBConnection.php";
require "FilePresenter.php";
require "../uses/jdf.php";

use \Slim\Http\Request;
use \Slim\Http\Response;

$app = new \Slim\App();

$app->post('/download', function (Request $req, Response $res) {
    $data = $req->getParsedBody();
    $result = (new FilePresenter())->download($data);
    $res->getBody()->write($result);
});

$app->post('/getType', function (Request $req, Response $res) {
    $data = $req->getParsedBody();
    $result = (new FilePresenter())->getType($data);
    $res->getBody()->write($result);
});

$app->get('/test', function (Request $req, Response $res) {
    $result = dirname(__FILE__);
    $res->getBody()->write($result);
});

$app->run();