<?php

session_start();

use App\Controller\ControllerClient;
use App\Controller\ControllerSite;
use App\Controller\ControllerUser;
use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollector;
use Slim\Routing\RouteCollectorProxy;

require_once('vendor/autoload.php');
require_once('functions.php');

$app = AppFactory::create();
$app->addRoutingMiddleware();

// SITE
$app->get('/', [ControllerSite::class, 'app']);
$app->map(['GET', 'POST'], '/login', [ControllerSite::class, 'login']);
$app->get('/logout', [ControllerSite::class, 'logout']);
$app->map(['GET', 'POST'], '/forgot-password', [ControllerSite::class, 'forgotPassword']);

// USER
$app->map(['GET', 'POST'], '/registration', [ControllerUser::class, 'registration']);
$app->get('/user/list', [ControllerUser::class, 'userList']);

// CLIENT
$app->map(['GET', 'POST'], '/client/register', [ControllerClient::class, 'clientRegister']);
$app->get('/client/list', [ControllerClient::class, 'clientList']);

//
$errorMiddleware = $app->addErrorMiddleware(true, true, true);

$app->run();

// $app->group('/', function(RouteCollectorProxy $group){

// });  