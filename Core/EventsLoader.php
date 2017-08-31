<?php
/**
 * Created by PhpStorm.
 * User: codeurx
 * Date: 31/08/2017
 * Time: 11:48
 */

namespace CMS;


use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;

class EventsLoader extends Dispatcher
{
    public function __construct()
    {
        new Dispatcher(new Container());
    }
}