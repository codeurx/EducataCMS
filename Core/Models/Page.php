<?php
/**
 * Created by PhpStorm.
 * User: codeurx
 * Date: 31/08/2017
 * Time: 10:22
 */

namespace CMS\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Page extends Eloquent {

    protected $table      = 'pages';
    protected $primaryKey = 'page_id';

    public static function GetPage($id,$title)
    {
        return Page::where('page_id','=',$id)->where('page_title','=',$title)->get();
    }
}