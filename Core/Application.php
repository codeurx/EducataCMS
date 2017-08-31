<?php
/**
 * Created by PhpStorm.
 * User: codeurx
 * Date: 27/08/17
 * Time: 11:18
 */

namespace CMS;

use CMS\Bootstrap;
use Symfony\Component\Debug\Debug;
use Webmozart\PathUtil\Path;
use Illuminate\Container\Container;


class Application extends Bootstrap{

    private $Path;

    public function __construct($Path)
    {
        new Database();
        $this->Path = Path::canonicalize($Path);
        Debug::enable();
    }

    public function start(){
        $bootstrap = new Bootstrap();
        $bootstrap->InitPlugins($this->Path);
        $bootstrap->GetRoute();
    }
}