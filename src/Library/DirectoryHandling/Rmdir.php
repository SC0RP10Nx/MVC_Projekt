<?php
declare(strict_types=1);

namespace dateninjson\Library\DirectoryHandling;




use dateninjson\Exceptions\Verzeichniserstellung\ErrorInVerzeichnis;

class Rmdir extends DirectoryHandling
{
    /**
     * @var string $info
     */
    private string $info;
    private bool $erfolg = false;

    /**
     * @param string|null $zielPath
     * @param string|null $verzeichnisdel
     * @throws ErrorInVerzeichnis
     */
    public function __construct(protected string|null $zielPath = NULL, protected string|null $verzeichnisdel = NULL)
    {
        parent::__construct($zielPath);
        ($verzeichnisdel) ?: throw new ErrorInVerzeichnis('Kein Verzeichnis zum Löschen vorhanden');
        parent::getExistsPath() ?: throw new ErrorInVerzeichnis('Der angegebene Path ist nicht korrekt!');
    }

    /**
     * @param $value
     * @return void
     */
    private function delAllFile($value):void
    {
        /**Mit unlink() kann man eine Datei (filename) vom Server löschen.
        Sollte ein Fehler auftreten, so gibt diese Funktion false zurück.
        Sie können die interne Fehlermeldung von PHP unterdrücken, indem Sie der Funktion ein "@" voranstellen.
        Somit wird dann nur die eventuell von Ihnen erzeugte Fehlermeldung ausgegeben.
         */
        if (!@unlink($value)) {
            $this->erfolg = false;
        }

        $this->info = $this->erfolg
            ? 'Alle Dateien erfolgreich geloescht'
            : 'Alle Dateien wurden nicht geloescht';
    }


    /**
     * @return void
     * @throws ErrorInVerzeichnis
     */
    public function setDelAllFile():void
    {
        $dirpath = $this->zielPath . $this->verzeichnisdel . '/*';
        $dirpathArray = glob($dirpath . '.*');
        $this->erfolg = true;
        //Die Funktion array_walk() übergibt jedes Element eines Arrays (arr) nacheinander an die Rückruffunktion function.
        (!empty($dirpathArray)) ? array_walk($dirpathArray, array($this, 'delAllFile')) : throw new ErrorInVerzeichnis('Keine File zum Löschen vorhanden!');
    }

    /**
     * @return void
     */
    public function setDelVerzeichnis():void
    {
        $this->erfolg = @rmdir($this -> zielPath . $this->verzeichnisdel);
        $this->info = $this->erfolg ? 'Verzeichnis erfolgreich geloescht' : 'Verzeichnis wurde nicht geloescht';
    }

    /**
     * @return string
     */
    public function getMeldung(): string
    {
        return $this->info ?? '';
    }
    public function getErfolg(): bool
    {
        return $this -> erfolg;
    }

}