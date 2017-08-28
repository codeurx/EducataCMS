<?php
/**
 * Created by PhpStorm.
 * User: codeurx
 * Date: 28/08/2017
 * Time: 13:06
 */

namespace CMS;

use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Routing\Router;
use Illuminate\Routing\UrlGenerator;

class Route {
    public function __construct(){
    echo 'fuck';
        $container = new Container;
        $request = Request::capture();
        $container->instance('Illuminate\Http\Request', $request);
        $events = new Dispatcher($container);
        $router = new Router($events, $container);
        require_once 'routes.php';
        $redirect = new Redirector(new UrlGenerator($router->getRoutes(), $request));
        $response = $router->dispatch($request);
        $response->send();
    }
}