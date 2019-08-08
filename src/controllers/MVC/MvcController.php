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
        $this->eventDispatcher->attach($this->callDatabase, array($this, 'initializeDB'));
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

        // odkomentovat ve chvily kdy je pripravena databaze
        // vyhledani dvou prvku v databazi
//        $first = Segment::where('name', 'template1')->first();
//        $second = Segment::where('name', 'template2')->first();

        // zakomentovat po pripraveni databaze
        $first = new class {
            public $title = "Template";
            public $subtitle = "MVC View";
            public $content = "View functionality in our MVC Micro Framework is backed by the Template class 
            (Template View design pattern). When creating a view, the variable name will be placed in curly brackets 
            where we want to display values from the logical part of the application. For example {value}. These values 
            must be correctly assigned in the controller.";
        };
        $second = new class {
            public $title = "";
            public $subtitle = "Inserting values";
            public $content = "Each segment on these example pages contains a paragraph or a first and second order 
            heading. A template system is used on this page replacing the Template tags with associated values.";
        };

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
        Database::GetInstance();
    }


}
