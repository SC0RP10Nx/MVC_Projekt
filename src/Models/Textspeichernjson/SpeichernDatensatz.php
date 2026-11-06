<?php

namespace dateninjson\Models\Textspeichernjson;

use dateninjson\Exceptions\Textspeichernjson\ErrorInTextspeichern;
use dateninjson\Library\DirectoryHandling\DirectoryHandling;

class SpeichernDatensatz extends DirectoryHandling
{
    /**
     * @var array $datensaetze
     */
    private array $datensaetze = array();
    /**
     * @var string $info
     */
    private string $info = '';
    /**
     * @param string|null $path
     * @param string|null $file
     * @param array|null $datensatz
     * @throws ErrorInTextspeichern
     */
    public function __construct(protected null|string $path = null, protected null|string $file = null, protected null|array $datensatz = null)
    {
        parent::__construct($path, $file);
        parent::getExistsPath() ?: throw new ErrorInTextspeichern('Der angegebene Path stimmt nicht!');
        parent::getIsWritable() ?: throw new ErrorInTextspeichern('Keine Schreibrechte!');
        ($this->datensatz !== null) ?: throw new ErrorInTextspeichern('Kein Datensatz vorhanden');
        parent::getExistsFile() && parent::getIfNotEmpty() ? $this->newDatensatzInsert() : $this->ifEmptyDatensatzInsert();
    }

    /**
     * @return void
     *  Wird aufgerufen, wenn Datei leer oder nicht vorhanden ist.
     *  Erstellt eine neue Datensatzliste mit einem Eintrag.
     */
    private function ifEmptyDatensatzInsert(): void
    {
        $this->datensaetze[] = $this->datensatz;
        $this->datensatzSpeichern();
    }

    /**
     * @return void
     *  Fügt einen neuen Datensatz zu bestehenden JSON-Daten hinzu.
     * @throws ErrorInTextspeichern
     */
    private function newDatensatzInsert(): void
    {
        // Liest vorhandene JSON-Daten aus Datei
        $content = file_get_contents($this->tothefile);
        if($content === false){
            throw new ErrorInTextspeichern('Fehler beim Lesen der Datei!');
        }
        $data = json_decode($content, true);
        //json_last_error() gibt einen Fehlercode zurück (eine Zahl).
        //JSON_ERROR_NONE bedeutet: kein Fehler.
        //eine verständliche Textbeschreibung des Fehlers zurück.
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new ErrorInTextspeichern('JSON ungültig: ' . json_last_error_msg());
        }
        // Falls Datei leer/ungültig ist → leeres Array
        if (!is_array($data)) {
            $data = [];
        }
        // Fügt neuen Datensatz hinzu
        $data[] = $this->datensatz;
        // Speichert alle Datensätze intern
        $this->datensaetze = $data;
        // Speichert in Datei
        $this->datensatzSpeichern();
    }

    /**
     * @return void
     */
    private function datensatzSpeichern(): void
    {
       $speichern = file_put_contents($this->getToTheFile(),json_encode($this->datensaetze),LOCK_EX);
       $this->info = ($speichern)? 'Datensatz erfolgreich gespeichert!' : 'Datensatz nicht erfolgreich gespeichert!';
    }

    /**
     * @return string
     */
    public function getMeldung():string
    {
        return $this->info;
    }
}