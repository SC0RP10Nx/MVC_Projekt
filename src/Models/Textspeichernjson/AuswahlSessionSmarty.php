<?php

namespace dateninjson\Models\Textspeichernjson;

class AuswahlSessionSmarty
{
    /**
     * @param string $item
     * @return void
     */
    public function sessionInput(string $item): void
    {
        echo $_SESSION[$item] ?? '';
    }

    /**
     * @param string $item
     * @param string|int|float $value
     * @param string $attr
     * @return void
     */
    public function checkedselectedFeld(string $item, string|int|float $value, string $attr): void
    {
        echo (isset($_SESSION[$item]) && $_SESSION[$item] == $value) ? $attr : false;
    }

    /**
     * @param string $item
     * @param string|int|float $value
     * @param string $attr
     * @return void
     */
    public function arrayFeld(string $item, string|int|float $value, string $attr): void
    {
        echo (!empty($_SESSION[$item]) && in_array($value, $_SESSION[$item])) ? $attr : false;
    }
}