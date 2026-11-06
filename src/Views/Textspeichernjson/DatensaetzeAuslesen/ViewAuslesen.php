<?php

namespace dateninjson\Views\Textspeichernjson\DatensaetzeAuslesen;



use dateninjson\Exceptions\Textspeichernjson\ErrorInTextspeichern;

class ViewAuslesen
{
    /**
     * @return void
     * @throws ErrorInTextspeichern
     */
    static public function getAuslesen(): void
    {
        $_SESSION['smarty']->display(__DIR__ . '/index.tpl');
        //!isset($_SESSION['datensatz']) ? throw new ErrorInTextspeichern('Keine Daten übergeben!!') : $_SESSION['smarty']->display(__DIR__ . '/index.tpl');
    }
}
