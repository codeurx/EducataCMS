<?php
/**
 * Created by PhpStorm.
 * User: codeurx
 * Date: 27/08/17
 * Time: 11:18
 */

namespace CMS;

use CMS\Database as Database;
use CMS\Bootstrap as Bootstrap;
use Symfony\Component\Debug\Debug;
use Webmozart\PathUtil\Path as Path;
use Symfony\Component\Debug\Debug as Debugger;

/**
 * Class Application
 * @package CMS
 */
class Application extends Bootstrap{
    /**
     * @var \CMS\Database
     */
    private $database;
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
        Debugger::enable();
        $this->database = new Database($this->Path);
        return $this->database;
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