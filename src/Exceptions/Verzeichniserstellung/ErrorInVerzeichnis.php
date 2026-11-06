<?php

namespace dateninjson\Exceptions\Verzeichniserstellung;

use Exception;
use Throwable;

class ErrorInVerzeichnis extends Exception
{
    /**
     * @param $message
     * @param $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        file_put_contents(__DIR__.'/Logs/ErrorInVerzeichnis.log',parent::getTraceAsString().date("m.d.y-H:i:s")."\n",FILE_APPEND);
    }
}