<?php

namespace dateninjson\Views\Textspeichernjson\Ueberpruefung;

class ViewUeberpruefung
{
    /**
     * @return void
     */
    static public function getPruefung(): void
    {
        $_SESSION['smarty']->display(__DIR__ . '/index.tpl');
    }
}