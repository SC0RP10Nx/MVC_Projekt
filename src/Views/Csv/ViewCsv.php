<?php

namespace dateninjson\Views\Csv;

class ViewCsv
{
    /**
     * @return void
     */
    static function getCsv(): void
    {
        $_SESSION['smarty']->display(__DIR__ . '/index.tpl.html');
    }
}