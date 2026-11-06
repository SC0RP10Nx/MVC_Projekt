<?php

namespace dateninjson\Library\Tools;

class AnzeigeTool
{
    /**
     * @param array|object|int|float|string|null $param
     * @return void
     */
    static public function printr(array|object|null|int|float|string $param): void
    {
        if(is_null($param)) {
            echo 'ins Null';
        }
        elseif (is_string($param)||is_int($param)||is_float($param)) {
            echo $param;
        }
        else{
            echo PRE;
            print_r($param);
            echo UPRE;
        }
    }
}