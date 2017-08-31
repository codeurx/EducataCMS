<?php
/**
 * Created by PhpStorm.
 * User: codeurx
 * Date: 27/08/17
 * Time: 20:35
 */

namespace CMS;

use Philo\Blade\Blade;
use Symfony\Component\Yaml\Yaml;
use CMS\Routing;
use CMS\Database;

class Bootstrap {

    public function InitPlugins($Path) {
        $plugins = Yaml::parse(file_get_contents($Path.'/Plugins/Plugins.yml'));
        foreach ($plugins as $plugin){
            foreach ($plugin as $p){
                //TODO compare the version of the plugin with cms's version
                require $Path.'/Plugins/'.$p['FolderName'].'/autoload.php';
            }
        }
    }

    public function GetRoute()
    {
        if (!isset($_GET['url'])){
            $_GET['url'] = '/';
        }
        new Routing($_GET['url']);
    }
}