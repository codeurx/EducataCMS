<?php
/**
 * Created by PhpStorm.
 * User: codeurx
 * Date: 30/08/2017
 * Time: 09:34
 */

namespace CMS\Middleware;

use Closure;

class Authenticate {
    public function handle($request, Closure $next, $guard = null){
        if (!isset($_SESSION['user'])) {
            return 'Error Authenticate. Please <a href="/login">login</a>';
        }
        return $next($request);
    }
}
