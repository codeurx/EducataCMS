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
use Illuminate\Routing\Router;
use Symfony\Component\Yaml\Yaml as Yml;

class Routing {
    public function __construct($url){
        $url_slug = $this->LoadSettings()['url_slug'];
        $requested_url = explode('/', $url);
        $url_length = count($requested_url);
        $liste_urls = array('Page'.$url_slug,'Article'.$url_slug,'Categorie'.$url_slug,'Cours'.$url_slug,'Nous-Contacter'.$url_slug);
        $events     = new Dispatcher(new Container);
        $router     = new Router($events);
        $routeMiddleware = [
            'auth'  => \CMS\Middleware\Authenticate::class,
            'guest' => \CMS\Middleware\RedirectIfAuthenticated::class,
        ];
        foreach ($routeMiddleware as $key => $middleware) {
            $router->aliasMiddleware($key, $middleware);
        }
        if ((in_array(end($requested_url),$requested_url) == 1)&&($url_length == 3)){
            if (end($requested_url)=='Page'.$url_slug){
                $router->group(['namespace' => 'CMS\Controllers', 'prefix' => '/{id}/{title}/Page'.$url_slug], function (Router $router) {
                    $router->get('/', ['name' => 'page.index', 'uses' => 'PagesController@index']);
                });
            }else if (end($requested_url)=='Article.Edu'){
                echo 'load Post Controller';
            }else if (end($requested_url)=='Categorie.Edu'){
                echo 'load Categories Controller';
            }else if (end($requested_url)=='Cours.Edu'){
                echo 'load Courses Controller';
            }
        }
        $router->get('/', function () {
            return 'Home Page!';
        });
        $request = Request::capture();
        $response = $router->dispatch($request);
        $response->send();
    }

    public function LoadSettings()
    {
        return $settings = Yml::parse(file_get_contents('Config/Settings.yml'));
    }
}