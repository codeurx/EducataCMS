<?php
/**
 * Created by PhpStorm.
 * User: codeurx
 * Date: 29/08/2017
 * Time: 12:36
 */

namespace CMS\Controllers;

use CMS\Models\Page;
use CMS\View;

class PagesController extends View {

    public function GetPage($id,$title){
        $title = str_replace('-',' ',$title);
        $page  =  Page::GetPage($id,$title);
        return $this->make('Page.content', ['title'=>$title,'page' => $page]);
    }
}