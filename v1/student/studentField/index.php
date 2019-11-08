<?php
/**
 * Created by PhpStorm.
 * User: Mostafa
 * Date: 28/09/2019
 * Time: 09:47 PM
 */

require "../../../vendor/autoload.php";
require "../../uses/DBConnection.php";
require "FieldPresenter.php";

use Slim\Http\Request;
use Slim\Http\Response;

$c = ['settings' => ['displayErrorDetails' => true,],];
$app = new \Slim\App($c);

$app->post('/',function(Request $req, Response $res){
    $result = (new FieldPresenter())->getFieldList($req->getParsedBody());
    $res->getBody()->write($result);
});

$app->run();