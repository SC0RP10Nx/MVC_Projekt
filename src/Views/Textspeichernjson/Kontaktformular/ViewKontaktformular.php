<?php

namespace dateninjson\Views\Textspeichernjson\Kontaktformular;

use dateninjson\Library\Tools\AnzeigeTool;
use dateninjson\Models\Textspeichernjson\AuswahlSessionSmarty;

class ViewKontaktformular
{
    /**
     * @return void
     */
    static function getKontaktformular(): void
    {
        $_SESSION['smarty']->assign('auswahlSession',new AuswahlSessionSmarty());
        $_SESSION['smarty']->display(__DIR__ . '/index.tpl');
    }
}