<?php

// urceni jmenneho prostoru
namespace Controllers\MVC;

// import use
use Config\Database;
use EventDispatcher\EventDispatcherInterface;
use EventDispatcher\StoppableEventInterface;
use MVC\Controller;
use Models\Segment;

// rozsireni abstraktni tridy Controller
class MvcController extends Controller
{
    // deklarace promennych
    private $eventDispatcher;
    private $callDatabase;

    // konstruktor, ve kterem se nastaví Event Dispatcher
    public function __construct(EventDispatcherInterface $eventDispatcher, StoppableEventInterface $event)
    {
        // pripraveni view, timto se da abstraktnimu controlleru vedet, ze chceme vyuzivat predpriparveneho
        // vzoru Template View
        $this->setView();

        $this->eventDispatcher = $eventDispatcher;
        $this->callDatabase = $event;
        $this->eventDispatcher->attach($this->callDatabase, array($this, 'getDatabaseInstance'));
    }

    // nasledujici funkce jsou volany jako akce routy

    public function mvc()
    {
        $this->view->render("MVC/MVC.html");
    }

    public function template()
    {

        // vyvolani akce, ktera pripravi databazi
        $this->eventDispatcher->dispatch($this->callDatabase);

        // vyhledani dvou prvku v databazi
        $first = Segment::where('name', 'template1')->first();
        $second = Segment::where('name', 'template2')->first();

        // prirazeni hodnot prvku z databaze do NV Template View
        $this->view->assignValue("title1", $first->title);
        $this->view->assignValue("subtitle1", $first->subtitle);
        $this->view->assignValue("content1", $first->content);

        $this->view->assignValue("title2", $second->title);
        $this->view->assignValue("subtitle2", $second->subtitle);
        $this->view->assignValue("content2", $second->content);

        $this->view->render("MVC/Template.html");
    }

    public function dispatcher()
    {
        $this->view->render("MVC/EventDispatcher.html");
    }

    // metoda pro ziskani pripojeni k databazi
    public function initializeDB()
    {
        Database::initialize();
    }


}
