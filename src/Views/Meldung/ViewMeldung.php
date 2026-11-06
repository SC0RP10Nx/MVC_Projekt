<?php

namespace dateninjson\Views\Meldung;

class ViewMeldung
{
    /**
     * @param string|array $meldung
     * @param string $link
     * @return void
     */
    static public function getMeldung(string|array $meldung,string $link='/'):void
    {
        $_SESSION['smarty']->assign('meldung',$meldung);
        $_SESSION['smarty']->assign('link',$link);
        $_SESSION['smarty']->display(__DIR__ . '/index.tpl.html');
    }
}