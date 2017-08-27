<?php
/**
 * Created by PhpStorm.
 * User: codeurx
 * Date: 27/08/17
 * Time: 11:35
 */

require 'vendor/autoload.php';
use CMS\Application as App;
$app = new App(realpath(__DIR__));
$app->start();