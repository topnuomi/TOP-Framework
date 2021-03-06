<?php

namespace top\library\error;

use Throwable;
use top\library\exception\BaseException;

class BaseError extends \Error
{

    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    /**
     * @param $errno
     * @param $errstr
     * @param $errfile
     * @param $errline
     * @throws BaseException
     */
    public function handler($errno, $errstr, $errfile, $errline)
    {
        throw new BaseException($errstr, 0, null, $errfile, $errline);
        // echo '<p style="font-size: 12px; font-weight: 100;">' . $content . '</p>';
    }
}
