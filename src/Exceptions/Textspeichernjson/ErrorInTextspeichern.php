<?php

namespace dateninjson\Exceptions\Textspeichernjson;

use Exception;
use Throwable;

class ErrorInTextspeichern extends Exception
{
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        file_put_contents(__DIR__ . '/Logs/ErrorInTextspeichern.log', date('Y-m-d H:i:s') . ' ' . parent::getTraceAsString() . ' ' . parent::getMessage() . "\n", FILE_APPEND);
    }
}