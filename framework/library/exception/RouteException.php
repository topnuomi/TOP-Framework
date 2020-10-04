<?php

namespace top\library\exception;

class RouteException extends BaseException
{
    public function __construct($message = "", $code = 0, \Throwable $previous = null)
    {
        parent::__construct('[RouteException]' . $message, $code, $previous);
    }

    /**
     * @param \Exception $exception
     */
    public function handler($exception = null)
    {
        parent::handler($this); // TODO: Change the autogenerated stub
    }
}
