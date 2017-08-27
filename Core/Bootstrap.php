<?php
/**
 * Created by PhpStorm.
 * User: codeurx
 * Date: 27/08/17
 * Time: 20:35
 */

namespace CMS;

use Symfony\Component\Yaml\Yaml as Yml;
use CMS\Exception as Error;

class Bootstrap
{
    public function InitPlugins($Path) {
        $plugins = Yml::parse(file_get_contents($Path.'/Plugins/Plugins.yml'));
        foreach ($plugins as $p){
            foreach ($p as $p){
                require $Path.'/Plugins/'.$p['FolderName'].'/autoload.php';
            }
        }
    }
}