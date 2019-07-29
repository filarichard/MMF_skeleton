<?php

// urceni jmenneho prostoru
namespace Config;

// import use
use Illuminate\Database\Capsule\Manager as Capsule;

// nastaveni databaze pomoci Caupsule Manager z frameworku Laravel
class Database
{
    private static $instance;

    private function __construct()
    {
        $capsule = new Capsule;
        $capsule->addConnection([
            "driver" => "mysql",
            "host" => "127.0.0.1",
            "database" => "test",
            "username" => "root",
            "password" => ""
        ]);

        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }

    // zajisteni NV Singleton
    public static function initialize()
    {
        if (self::$instance === null) {
            self::$instance = new self;
        }
    }
}
