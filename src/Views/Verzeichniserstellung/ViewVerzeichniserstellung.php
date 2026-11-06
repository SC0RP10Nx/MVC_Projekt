<?php

namespace dateninjson\Views\Verzeichniserstellung;

class ViewVerzeichniserstellung
{
    /**
     * @return void
     */
    static function getVerzeichniserstellung(): void
    {
        $_SESSION['smarty']->display(__DIR__ . '/VerzAuswahlFormular/index.tpl.html');
    }
}