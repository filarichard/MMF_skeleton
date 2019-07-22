<?php

// vytvoreni vlastniho routeru

use MVC\Router\Router;
use MVC\Router\Route;

$router = new Router();

$router->addRoute(new Route("/", \Controllers\MVC\MvcController::class, "mvc"));
$router->addRoute(new Route("/mvc", \Controllers\MVC\MvcController::class, "mvc"));
$router->addRoute(new Route("/template", \Controllers\MVC\MvcController::class, "template"));
$router->addRoute(new Route("/eventDispatcher", \Controllers\MVC\MvcController::class, "dispatcher"));

$router->addRoute(new Route("/thirdPartiesComponents", \Controllers\ThirdPartiesController::class, "tpc"));

return $router;
