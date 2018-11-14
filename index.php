<?php
require("vendor/autoload.php");
require ("start.php");


use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// use Controllers\;
use Controllers\UserController;

require "settings.php";

$app = new \Slim\App($config);
$container = $app->getContainer();
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};
require "middlewares.php";
require "routes.php";

		
$app->run();

?>