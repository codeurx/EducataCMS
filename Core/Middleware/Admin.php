<?php
/**
 * Created by PhpStorm.
 * User: codeurx
 * Date: 30/08/2017
 * Time: 09:34
 */

namespace CMS\Middleware;

use Closure;

class Admin{
    public function handle($request, Closure $next, $guard = null){
        if (!isset($_SESSION['admin'])) {
            header('Location:Admin/Login');
        }
        return $next($request);
    }
}
