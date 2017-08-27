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
use Webmozart\PathUtil\Path as Path;

/**
 * Class Application
 * @package CMS
 */
class Application
{
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
        \Symfony\Component\Debug\Debug::enable();
        $this->database = new Database($this->Path);
        return $this->database;
    }

    /**
     *
     */
    public function start(){
        $bootstrap = new Bootstrap();
        $bootstrap->InitPlugins($this->Path);
    }
}