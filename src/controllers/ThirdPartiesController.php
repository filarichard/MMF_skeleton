<?php

// urceni jmenneho prostoru
namespace Controllers;

// import use
use MVC\Controller;

// rozsireni abstraktni tridy Controller
class ThirdPartiesController extends Controller
{
    // deklarace promenne
    private $logger;

    // konstruktor, ve kterem se vyzkousi komponenta logger
    public function __construct($logger)
    {
        $this->setView();

        $this->logger = $logger;

        $this->logger->debug("__construct " . date("h:i:s"));
    }

    // funkce, ve ktere se vyzkousi komponenta logger
    public function tpc()
    {
        $this->logger->notice("tpc " . date("h:i:s"));

        $this->view->render("ThirdPartiesComponents.html");
    }
}
