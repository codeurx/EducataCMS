<?php
/**
 * Created by PhpStorm.
 * User: codeurx
 * Date: 30/08/2017
 * Time: 09:46
 */

namespace CMS\Middleware;

use Closure;

class RedirectIfAuthenticated {

    public function handle($request, Closure $next, $guard = null){
        if(isset($_SESSION['user'])){
            return 'Error Authenticate';
        }
        return $next($request);
    }
}
