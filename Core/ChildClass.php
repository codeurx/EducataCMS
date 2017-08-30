<?php
/**
 * Created by PhpStorm.
 * User: codeurx
 * Date: 30/08/2017
 * Time: 14:06
 */

namespace CMS;


class ChildClass
{
    protected $bar;


    public function __construct(ParentClass $bar)
    {
        $this->bar = $bar;
    }

    public function doSomething()
    {
        return $this->bar->somethingToDo();
    }
}