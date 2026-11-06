<?php

namespace dateninjson\Views\Datatables;

class ViewDatatables
{
    /**
     * @return void
     */
    static function getDatatables(): void
    {
        $_SESSION['smarty']->display(__DIR__ . '/index.tpl.html');
    }
}