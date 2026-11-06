<?php

namespace dateninjson\Controllers\Verzeichniserstellung;

use dateninjson\AbstractClass\Controller\AController;
use dateninjson\Exceptions\Verzeichniserstellung\ErrorInVerzeichnis;
use dateninjson\Library\DirectoryHandling\AuslesenDir;
use dateninjson\Library\DirectoryHandling\Mkdir;
use dateninjson\Library\DirectoryHandling\Rmdir;
use dateninjson\Library\DirectoryHandling\VerzeichnisAuslesen;
use dateninjson\Models\Downloadimg\Upload;
use dateninjson\Views\Verzeichniserstellung\DownloadFormular\ViewDownloadFormular;
use dateninjson\Views\Verzeichniserstellung\Galerie\ViewGalerie;
use dateninjson\Views\Verzeichniserstellung\VerzAuswahlFormular\ViewVerzAuswahl;
use dateninjson\Views\Verzeichniserstellung\UploadFormular\ViewUploadFormular;

class Controller extends AController
{
    public function indexAction():void
    {
        $auslesen = new VerzeichnisAuslesen();
        $_SESSION['verzeichnisse'] = $auslesen->getVerzeichnis(PATHIMAGEUPLOAD);
        ViewVerzAuswahl::getContent();
        unset($_SESSION['meldung']);
    }

    public function mkdirAction():void
    {
        $mkdir = new Mkdir(PATHIMAGEUPLOAD,$_POST['neuesVerzeichnis'] ?? null);
        $_SESSION['meldung'] = $mkdir->getMeldung();
        $_SESSION['meldungErfolg'] = $mkdir->getErfolg();
        header('Location: /verzeichniserstellung');
        exit;
    }

    public function uploadViewAction():void
    {
        $_SESSION['verzeichnis'] = $_POST['verzeichnis']?? null;
        ViewUploadFormular::getContent();
    }
    public function uploadAction():void
    {
        $upload = new Upload(PATHIMAGEUPLOAD.$_SESSION['verzeichnis'],UPLOADTYP,ErrorInVerzeichnis::class,'files');
        echo $upload ->getMeldung();
    }

    public function downloadAction():void
    {
        $_SESSION['verzeichnis'] = $_POST['verzeichnis']?? null;
        $auslesenDir = new AuslesenDir(PATHIMAGEUPLOAD.$_SESSION['verzeichnis'],'*.{jpg,jpeg,png,gif,tiff}');
        ViewDownloadFormular::getContent($auslesenDir->getAuslesenDir());
    }
    public function verzeichnisDelAction():void
    {
        $_SESSION['verzeichnis'] = $_POST['verzeichnis']?? null;
        $rmDir = new RmDir(PATHIMAGEUPLOAD,$_SESSION['verzeichnis']);
        $rmDir->setDelVerzeichnis();
        $_SESSION['meldung'] = $rmDir->getMeldung();
        $_SESSION['meldungErfolg'] = $rmDir->getErfolg();
        header('Location: /verzeichniserstellung');
        exit;
    }

    public function verzeichnisInhaltDelAction():void
    {
        $_SESSION['verzeichnis'] = $_POST['verzeichnis']?? null;
        $rmDir = new RmDir(PATHIMAGEUPLOAD,$_SESSION['verzeichnis']);
        $rmDir->setDelAllFile();
        $_SESSION['meldungErfolg'] = $rmDir->getErfolg();
        $_SESSION['meldung'] = $rmDir->getMeldung();
        header('Location: /verzeichniserstellung');
        exit;
    }

    public function galerieAction():void
    {
        $_SESSION['verzeichnis'] = $_POST['verzeichnis']?? null;
        ViewGalerie::getContent();
    }

    /**
     * @return string
     */
    public function imgladenAction(): void
    {
        $auslesenDir = new AuslesenDir(PATHIMAGEUPLOAD.$_SESSION['verzeichnis'],'*.{jpg,jpeg,png,gif,tiff}');
        echo json_encode($auslesenDir->getAuslesenDir()['imgName']);
    }
}