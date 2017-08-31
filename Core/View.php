<?php
/**
 * Created by PhpStorm.
 * User: codeurx
 * Date: 31/08/2017
 * Time: 11:09
 */

namespace CMS;

use Illuminate\Container\Container;
use Illuminate\Contracts\Container\Container as ContainerInterface;
use Illuminate\Events\Dispatcher;
use Illuminate\Filesystem\Filesystem;
use Illuminate\View\ViewServiceProvider;

class View{

    protected $container;
    protected $engineResolver;

    public function __construct(ContainerInterface $container = null){
        $this->viewPaths = 'Public/Views';
        $this->cachePath = 'Public/Cache';
        $this->container = $container ?: new Container;
        $this->setupContainer();
        (new ViewServiceProvider($this->container))->register();
        $this->engineResolver = $this->container->make('view.engine.resolver');
    }

    protected function setupContainer(){
        $this->container->bindIf('files', function () {
            return new Filesystem;
        }, true);
        $this->container->bindIf('events', function () {
            return new Dispatcher;
        }, true);
        $this->container->bindIf('config', function () {
            return [
                'view.paths' => (array) $this->viewPaths,
                'view.compiled' => $this->cachePath,
            ];
        }, true);
    }

    public function render($view, $data = [], $mergeData = []){
        return $this->container['view']->make($view, $data, $mergeData)->render();
    }

    public function compiler(){
        $bladeEngine = $this->engineResolver->resolve('blade');
        return $bladeEngine->getCompiler();
    }

    public function __call($method, $params){
        return call_user_func_array([$this->container['view'], $method], $params);
    }
}