<?php

namespace Yii1x\ActiveRecord\Exceptions;

use Exception;

class DbException extends Exception
{

    /**
     * Constructor.
     * @param string $message PDO error message
     * @param integer $code PDO error code
     * @param mixed $errorInfo PDO error info
     */
    public function __construct(string $message, int $code = 0, public mixed $errorInfo = null)
    {
        parent::__construct($message, $code);
    }
}