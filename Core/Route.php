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
    public function __construct()
    {
        $this->getRoute();
    }

    public function getRoute(){
        $requested = explode('/',$_SERVER['REQUEST_URI']);
        unset($requested[0]);
        $List_Urls = array('Page','Categorie','Article','Cours');
        if (!array_search($requested[1],$List_Urls)){
             unset($requested[1]);
        }
        $container = new Container;
        $request = Request::capture();
        $container->instance('Illuminate\Http\Request', $request);
        $events = new Dispatcher($container);
        $router = new Router($events, $container);

        if (array_search($requested[2],$List_Urls) == 0){
            $router->get("/{$requested[2]}", function () {
                return 'Page';
            });
        }else{
            $router->get('/', function () {
                return 'Home';
            });
        }
        $redirect = new Redirector(new UrlGenerator($router->getRoutes(), $request));
        $response = $router->dispatch($request);
        $response->send();
    }
}