<?php

namespace dateninjson\Library;

class AnzeigeTool
{
    /**
     * @param array|object|int|string|null $param
     * @return void
     */
    static public function printr(array|object|null|int|string|float $param): void
    {
        if (is_null($param)) {
            echo 'ist NULL';
        } elseif (is_string($param) || is_int($param)|| is_float($param)) {
            echo $param;
        } else {
            echo PRE;
            print_r($param);
            echo UPRE;
        }
    }
}