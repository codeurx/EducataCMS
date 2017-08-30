<?php
/**
 * Created by PhpStorm.
 * User: codeurx
 * Date: 27/08/17
 * Time: 20:35
 */

namespace CMS;

use Symfony\Component\Yaml\Yaml as Yml;
use CMS\Routing as Routing;

class Bootstrap {

    public function InitPlugins($Path) {
        $plugins = Yml::parse(file_get_contents($Path.'/Plugins/Plugins.yml'));
        foreach ($plugins as $plugin){
            foreach ($plugin as $p){
                //TODO compare the version of the plugin with cms's version
                require $Path.'/Plugins/'.$p['FolderName'].'/autoload.php';
            }
        }
    }

    public function GetRoute()
    {
        new Routing($_GET['url']);
    }
}