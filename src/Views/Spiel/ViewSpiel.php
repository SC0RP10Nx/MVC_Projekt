<?php

namespace dateninjson\Views\Spiel;

class ViewSpiel
{
    /**
     * @return void
     */
    static function getSpiel(): void
    {
        $_SESSION['smarty']->display(__DIR__ . '/index.tpl.html');
    }
}