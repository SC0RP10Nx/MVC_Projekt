<?php

namespace dateninjson\Views\Textspeichernjson\Login;

class ViewLogIn
{
    /**
     * @return void
     */
    public static function getLogIn():void
    {
        $_SESSION['smarty']->display(__DIR__ . '/index.tpl.html');
    }
}