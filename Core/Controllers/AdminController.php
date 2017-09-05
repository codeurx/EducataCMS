<?php
/**
 * Created by PhpStorm.
 * User: codeurx
 * Date: 30/08/2017
 * Time: 09:31
 */

namespace CMS\Controllers;

use Illuminate\Routing\Redirector as Redirector;
use Illuminate\Support\Facades\Redirect;
class AdminController {
    public function login()
    {
        $_SESSION['admin'] = true;
        return Redirect::to('profile', []);
    }
}