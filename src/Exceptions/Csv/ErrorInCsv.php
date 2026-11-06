<?php

namespace dateninjson\Exceptions\Csv;

use Exception;
use Throwable;

class ErrorInCsv extends Exception
{
    /**
     * @param $message
     * @param $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        file_put_contents(__DIR__ . '/Logs/ErrorInCsv.log', parent::getTraceAsString().date("m.d.y-H:i:s")."\n", FILE_APPEND);
    }
}