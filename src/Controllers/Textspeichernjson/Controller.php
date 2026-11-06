<?php

namespace dateninjson\Controllers\Textspeichernjson;

use dateninjson\AbstractClass\Controller\AController;
use dateninjson\Exceptions\Textspeichernjson\ErrorInTextspeichern;
use dateninjson\Models\Textspeichernjson\AuslesenDatensatz;
use dateninjson\Models\Textspeichernjson\PostZuSession;
use dateninjson\Models\Textspeichernjson\SpeichernDatensatz;
use dateninjson\Views\Meldung\ViewMeldung;
use dateninjson\Views\Textspeichernjson\DatensaetzeAuslesen\ViewAuslesen;
use dateninjson\Views\Textspeichernjson\Kontaktformular\ViewKontaktformular;
use dateninjson\Views\Textspeichernjson\Ueberpruefung\ViewUeberpruefung;
use dateninjson\Views\Textspeichernjson\Login\ViewLogIn;
use dateninjson\Models\Textspeichernjson\Login\Authentifizierung;
use http\Header;


class Controller extends AController
{
    /**
     * @return void
     */
    protected function getView(): void
    {
        ViewKontaktformular::getKontaktformular();
    }

    /**
     * @return void
     */
    public function sendenAction(): void
    {
        $instanzPostSession = new PostZuSession(INDEXARRAY, $_POST);
        $_SESSION['datensatz'] = $instanzPostSession->getDatensatz();
//        unset($_SESSION['datensatz']);
//        $_SESSION['datensatz']=array('ss');
        if (!is_array($_SESSION['datensatz'] ?? '') || empty($_SESSION['datensatz'] ?? '')) {
              throw new ErrorInTextspeichern('Kein Datensatz vorhanden');
        }
        foreach (INDEXARRAY as $key => $value) {
            if (!array_key_exists($key, $_SESSION['datensatz'])) {
                throw new ErrorInTextspeichern("Key '$key' fehlt");
            }
        }
        ViewUeberpruefung::getPruefung();
    }


    /**
     * @return void
     */
    public function speichernAction(): void
    {
            $config = $this->getConfig();
            $datensatz = $_SESSION['datensatz'] ?? null;
            if($datensatz === null){
                throw new ErrorInTextspeichern('Keine Datensatz in SESSION vorhanden');
            }
            $speichern = new SpeichernDatensatz($config['path'], $config['file'], $datensatz);
            ViewMeldung::getMeldung($speichern->getMeldung(),'/Textspeichernjson');
    }

    /**
     * @return void
     */
    public function zumloginAction(): void
    {
        ViewLogIn::getLogIn();
    }

    /**
     * @return void
     */
    public function logincontrolAction(): void
    {
        Authentifizierung::ueberpruefeLogin($_POST['username'] ?? null, $_POST['passwd'] ?? null);
    }

    public function toreadoutAction(): void
    {
        $this->requireAuslesen();
        $this->getAusgabe();
    }
    /**
     * @return void
     * @throws ErrorInTextspeichern
     */
    public function nextAction(): void
    {
        $this->requireAuslesen()->setNextDatensatz();
        $this->getAusgabe();
    }

    /**
     * @return void
     * @throws ErrorInTextspeichern
     */
    public function backAction(): void
    {
        $this->requireAuslesen()->setBackDatensatz();
        $this->getAusgabe();
    }

    /**
     * @return void
     * @throws ErrorInTextspeichern
     */
    public function delAction(): void
    {
        $auslesen = $this->requireAuslesen();
        $auslesen->setDelDatensatz();
        $ziel = empty($auslesen->getAllDatensaetze())
            ? '/textspeichernjson': 'textspeichernjson/toreadout';
        ViewMeldung::getMeldung($auslesen->getMeldung(), '/textspeichernjson/toreadout');
    }
    /**
     * @return void
     * @throws ErrorInTextspeichern
     */
    public function anfangDatensatzAction(): void
    {
        $this->requireAuslesen()->setAnfangDatensatz();
        $this->getAusgabe();
    }

    /**
     * @return void
     * @throws ErrorInTextspeichern
     */
    public function endeDatensatzAction(): void
    {
        $this->requireAuslesen()->setEndDatensatz();
        $this->getAusgabe();
    }

    /**
     * @return void
     * @throws ErrorInTextspeichern
     */
    public function destroyAction(): void
    {
        $_SESSION = [];
        session_destroy();
        header('Location: /textspeichernjson/zumlogin');
        exit;
    }



    /**
     * @return void
     * @throws ErrorInTextspeichern
     */
    private function getAusgabe(): void
    {
        $_SESSION['datensatz'] = $this->requireAuslesen()->getDatensatz();
        ViewAuslesen::getAuslesen();
    }

    /**
     * @return void
     */
    private function requireLogin(): void
    {
        if(!isset($_SESSION['login'])|| $_SESSION['login'] !== true)
        {
            header('Location: /textspeichernjson/zumlogin');
            exit;
        }
    }

    /**
     * @return AuslesenDatensatz
     * @throws ErrorInTextspeichern
     */
    private function requireAuslesen(): AuslesenDatensatz
    {
        $this->requireLogin();
        $config = $this->getConfig();
        return new AuslesenDatensatz($config['path'], $config['file']);
    }
    /**
     * @return array
     */
    private function getConfig():array
    {
        return [
            'path' => PATHSPEICHERORT,
            'file' => DATENSATZJSONFILE
        ];
    }
}