# MMF_skeleton
### Full implementation of MVC Micro Framework

MMF_skeleton is project, that shows how to implement mvc_micro_framework.

mvc_micro_framework is simple and lightweight PHP micro framework, that allows you easy and fast build of MVC applications. It's simple and extensible!

## Minimum requires
mvc_micro_framework requires `PHP 7.1` or grater.

## Installation
1. Download

**With Composer:**  
`composer require filarichard/mvc_micro_framework`

**Without Composer:**  
Download files and extract them directly to web directory.

2. Create **App** and call **run** function  
```php
$application = new \App\App();
$application->run();
```

3. Create **config.json** file in `/config` directory  
```json
{
  "routes": {
    "/third_parties_components": {
      "controller": "Controllers\\ThirdPartiesController",
      "action": "tpc"
    }
  },
  "modules": [
    "mvc"
  ],
  "diContainer": "config/diContainer.php"
}
```
Possible config values are:  
* routes - list of all routes used in the app, that doesn't use modules.
* modules - list of all modules used in the app.
* router - path to PHP fith configured router.
* diContainer - path to PHP fith configured DI Container.
* request - path to PHP fith configured HTTP Request.

## Routing
For fully working routing, use followed directory:
* config
* src
  * config
    * All configuration files for modules
    * modelname.config.json
  * controllers
    * All controllers
    * If defined, use Modul name
      * Modul Controllers
  * models
  * views

For Router setup, you can use on of the following choices:
1. Define routes in **config** file

All routes, that aren't included in modules, create in **config.json** file.  
All routes, that are in modules, create in **modulname.config.json** files.

Structure of route definition:
```json
"/nameOfRoute": {
    "controller": "Controllers\\NameOfController",
    "action": "nameofFunction"
  }
```

2. Define own **router** with all routes

```php
$router = new \MVC\Router();

$router->addRoute(new \MVC\Route("/nameOfRoute", \Controllers\NameOfController::class, "nameOfFunction"));

return $router;
```

## Template Engine
mvc_micro_framework have built-in Template Engine. Just follow these few steps:
1. Set template

```php
$this->setView();
```
2. Assign variables

```php
$this->view->assignValue("nameOfVariable", $value);

$this->view->assignValue("title1", $titleValue);
$this->view->assignValue("subtitle1", $subtitleValue);
$this->view->assignValue("content1", $contentValue);
```
3. Use those variables in **HTML** code

```html
<h1>{title1}</h1>
<h2>{subtitle1}</h2>
<p>
  {content1}
</p>
```
4. Render View

```php
$this->view->render("pathToFile.html");
```
Function **render** can take second parameter that define if path is full or relative to `/src/views`.

## Event Dispatcher
With following steps, you can use our Event Dispatcher:
1. Create new Dispatcher

```php
$this->eventDispatcher = new Dispatcher();
```
2. Create new Event

```php
$this->eventName = new Event("eventName");
```
3. Attach him to Listener

```php
$this->eventDispatcher->attach($this->eventName, array($this, 'listenerName'));
```
Note: Listener can be any Callable object.

4. Dispatch Event

```php
$this->eventDispatcher->dispatch($this->eventName);
```

You can also remove Event
```php
$this->eventDispatcher->detach($this->eventName, array($this, 'listenerName'));
```
or stop event propagation
```php
$this->eventName->setPropagationStopped(true);
```

## SQL
```sql
-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Čtv 22. srp 2019, 11:18
-- Verze serveru: 10.1.38-MariaDB
-- Verze PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `test`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `segments`
--

CREATE TABLE `segments` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `content` varchar(3000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Vypisuji data pro tabulku `segments`
--

INSERT INTO `segments` (`id`, `name`, `title`, `subtitle`, `content`) VALUES
(2, 'template1', 'Template', 'MVC View', '<b>View</b> functionality in our MVC Micro Framework is backed by the <b>Template</b> class (Template View design pattern). When creating a view, the variable name will be placed in curly brackets where we want to display values from the logical part of the application. For example <span class=\"blue\">{value}</span>. These values must be correctly assigned in the controller.'),
(3, 'template2', NULL, 'Inserting values', 'Each segment on these example pages contains a paragraph or a first and second order heading. A template system is used on this page replacing the Template tags with associated values.');

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `segments`
--
ALTER TABLE `segments`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `segments`
--
ALTER TABLE `segments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
```

## Third Parties Components
mvc_micro_framework support following components from third parties:
* HTTP Foundation/Symfony
* Eloquent (ORM)/Laravel
* Pimple (DI Container)
* Monolog (Logger)

## Packagist
https://packagist.org/users/richard.fila/packages/

## License
Flight is released under the MIT license.
