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

/**
 * Class Application
 * @package CMS
 */
class Application extends Bootstrap{
    /**
     * @var string
     */
    private $Path;

    /**
     * Application constructor.
     * @param $Path
     */
    public function __construct($Path)
    {
        $this->Path = Path::canonicalize($Path);
        Debug::enable();
    }

    /**
     *
     */
    public function start(){
        $bootstrap = new Bootstrap();
        $bootstrap->InitPlugins($this->Path);
        $bootstrap->GetRoute();
    }
}