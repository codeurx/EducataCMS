<?php
/**
 * Created by PhpStorm.
 * User: codeurx
 * Date: 27/08/17
 * Time: 11:35
 */

session_start();

require_once 'vendor/autoload.php';

use CMS\Application;

$app = new Application(realpath(__DIR__));

$app->start();