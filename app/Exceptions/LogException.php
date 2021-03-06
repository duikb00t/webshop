<?php

namespace App\Exceptions;

class LogException extends \Exception
{
    /**
     * Create a new LogException.
     *
     * @param  $message
     * @param  int  $code
     * @param  \Exception  $previous
     */
    public function __construct($message, $code = 0, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
