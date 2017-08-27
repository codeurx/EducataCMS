<?php
/**
 * Created by PhpStorm.
 * User: codeurx
 * Date: 27/08/17
 * Time: 18:47
 */

namespace CMS;

use Symfony\Component\Debug\ExceptionHandler;
use Symfony\Component\Debug\Exception\FlattenException;

/**
 * Class Exception
 * @package CMS
 */
class Exception
{
    /**
     * @param \Throwable $exception
     * @return string
     */
    public static function getErrorException(\Throwable $exception) {
        $handler = new ExceptionHandler();
        $flattened_exception = FlattenException::create($exception);
        $output = "<style>".$handler->getStylesheet($flattened_exception)."</style>".$handler->getContent($flattened_exception);
        return $output;
    }
}