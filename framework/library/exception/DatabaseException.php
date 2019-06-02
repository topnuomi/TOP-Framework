<?php

namespace top\library\exception;

use Throwable;

class DatabaseException extends BaseException {
    public function __construct($message = "", $code = 0, Throwable $previous = null) {
        $message = $this->processMessage($message);
        parent::__construct($message, $code, $previous);
    }

    public function handler($exception = null) {
        parent::handler($this); // TODO: Change the autogenerated stub
    }

    private function processMessage($message) {
        $message = str_ireplace([
            'database',
            'table',
            'doesn\'t exist',
            'unknown',
            'column',
            'field',
            'list'
        ],[
            '数据库: ',
            '表',
            '不存在',
            '未知',
            '列',
            '字段',
            '列表'
        ], $message);
        return $message;
    }
}