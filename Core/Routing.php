<?php
/**
 * Created by PhpStorm.
 * User: codeurx
 * Date: 29/08/2017
 * Time: 11:14
 */

namespace CMS;

use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Symfony\Component\Yaml\Yaml as Yml;

class Routing {
    public function __construct($url){
        new Database();
        $url_slug = $this->LoadUrlSettings()['url_slug'];
        $requested_url = explode('/', $url);
        $url_length = count($requested_url);
        $liste_urls = array('Page'.$url_slug,'Article'.$url_slug,'Categorie'.$url_slug,'Cours'.$url_slug,'Nous-Contacter'.$url_slug);
        $events     = new EventsLoader();
        $router     = new Router($events);
        $routeMiddleware = [
            'Admin'  => \CMS\Middleware\Admin::class,
        ];
        foreach ($routeMiddleware as $key => $middleware) {
            $router->aliasMiddleware($key, $middleware);
        }
        if ((in_array(end($requested_url),$liste_urls) == 1)&&($url_length == 3)){
            if (end($requested_url)=='Page'.$url_slug){
                $router->group(['namespace' => 'CMS\Controllers', 'prefix' => '/{id}/{title}/Page'.$url_slug], function (Router $router) {
                    $router->get('/', ['name' => 'page.GetPage', 'uses' => 'PagesController@GetPage']);
                });
            }else if (end($requested_url)=='Article.Edu'){
                echo 'load Post Controller';
            }else if (end($requested_url)=='Categorie.Edu'){
                echo 'load Categories Controller';
            }else if (end($requested_url)=='Cours.Edu'){
                echo 'load Courses Controller';
            }
        }
        if ($requested_url[0]=='Admin'){
            if (isset($_SESSION['admin'])){
                $router->group(['middleware' => 'Admin'], function (Router $router) {
                    $router->get('Admin', function () {
                        return 'Welcome admin!';
                    });
                    $router->get('Admin/Logout', function () {
                        unset($_SESSION['admin']);
                       return header('Location:Admin');
                    });
                });
            }else{
                $router->get('Admin', function () {
                    return 'Login Page Here!';
                });
                $router->group(['namespace' => 'CMS\Controllers', 'prefix' => 'Admin'], function (Router $router) {
                    $router->get('/Login', ['name' => 'Admin.login', 'uses' => 'AdminController@login']);
                    $router->get('/', function () {
                        return 'Login Page Here!';
                    });
                });
            }
        }
        $request  = Request::capture();
        $response = $router->dispatch($request);
        $response->send();
    }

    public function LoadUrlSettings()
    {
        return Yml::parse(file_get_contents('Config/Settings.yml'));
    }
}