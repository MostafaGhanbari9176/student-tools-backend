<?php
/**
 * Created by PhpStorm.
 * User: Mostafa
 * Date: 06/09/2019
 * Time: 10:07 PM
 */

use Slim\Http\Request;
use Slim\Http\Response;

require "../../../vendor/autoload.php";
require "../../uses/DBConnection.php";
require "InvitePresenter.php";
require "../../uses/jdf.php";


$c = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];
$app = new \Slim\App($c);
$app->post("/inviteMessage", function (Request $req, Response $res) {
    $data = $req->getParsedBody();
    $result = (new InvitePresenter())->inviteMessage($data);
    $res->getBody()->write($result);
});

$app->post('/accept',function (Request $req, Response $res){
    $data = $req->getParsedBody();
    $result = (new InvitePresenter())->accept($data);
    $res->getBody()->write($result);
});

$app->run();