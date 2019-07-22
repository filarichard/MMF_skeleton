<?php

// urceni jmenneho prostoru
namespace Config;

// import use
use EventDispatcher\Dispatcher;
use EventDispatcher\Event;
use Monolog\Handler\BrowserConsoleHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Pimple\Container;
use Symfony\Component\HttpFoundation\Request;

// vytvoreni Pimple DI Kontejneru
$container = new Container();

// prirazeni komponenty request do kontejneru
$container["request"] = function() {
    return Request::createFromGlobals();
};
// prirazeni komponenty logger do kontejneru
$container["logger"] = function () {
    $logger = new Logger("mainLogger");
    $logger->pushHandler(new BrowserConsoleHandler());
    $logger->pushHandler(new StreamHandler('log.txt',Logger::CRITICAL));

    return $logger;
};
// prirazeni komponenty event do kontejneru
$container["event"] = function () {
    $event = new Event("database");
//    $this->call_database->setPropagationStopped(true);
    return $event;
};
// prirazeni komponenty event dispatcher do kontejneru
$container["eventDispatcher"] = function () {
    return new Dispatcher();
};

// vraceni nastaveneho kontejneru
return $container;
