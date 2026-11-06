<?php

namespace dateninjson\Views\Verzeichniserstellung\VerzAuswahlFormular;


use dateninjson\Models\Textspeichernjson\AuswahlSessionSmarty;

class ViewVerzAuswahl
{
    /**
     * @return void
     */
    static public function getContent(): void
    {
        $_SESSION['smarty']->assign('AuswahlSession', new AuswahlSessionSmarty());
        $_SESSION['smarty']->display(__DIR__ . '/index.tpl.html');
    }
}

