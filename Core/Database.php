<?php
/**
 * Created by PhpStorm.
 * User: codeurx
 * Date: 31/08/2017
 * Time: 09:53
 */

namespace CMS;

use Symfony\Component\Yaml\Yaml;
use Illuminate\Database\Capsule\Manager as Capsule;

class Database {
    public function __construct(){
        $dbSettings = $this->LoadDatabaseSettings();
        $capsule    = new Capsule;
        $capsule->addConnection([
            'driver'    => $dbSettings->driver,
            'host'      => $dbSettings->host,
            'database'  => $dbSettings->database,
            'username'  => $dbSettings->username,
            'password'  => $dbSettings->password,
            'charset'   => $dbSettings->charset,
            'collation' => $dbSettings->collation,
            'prefix'    => $dbSettings->prefix
        ]);
        $capsule->bootEloquent();
    }

    public function LoadDatabaseSettings(){
        return (object)Yaml::parse(file_get_contents('Config/Database.yml'))['database'];
    }
}