<?php
/**
 * Created by PhpStorm.
 * User: codeurx
 * Date: 29/08/2017
 * Time: 11:14
 */

namespace CMS;

use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Routing\Router;
use Illuminate\Routing\UrlGenerator;


class Routing {

    public function __construct(){
        $container = new Container;
        $request = Request::capture();
        $container->instance('Illuminate\Http\Request', $request);
        $events = new Dispatcher($container);
        $router = new Router($events, $container);
        $router->group(['namespace' => 'App\Controllers', 'prefix' => 'Page'], function (Router $router) {
            $router->get('/', ['name' => 'Page.Salute', 'uses' => 'PageController@Salute']);
        });
        $router->get('/', function () {
            return 'goodbye world!';
        });
        $redirect = new Redirector(new UrlGenerator($router->getRoutes(), $request));
        $response = $router->dispatch($request);
        $response->send();
    }
}