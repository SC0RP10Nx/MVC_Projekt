<?php

namespace dateninjson\Models\Textspeichernjson;

use dateninjson\Exceptions\Textspeichernjson\ErrorInTextspeichern;
use dateninjson\Library\DirectoryHandling\DirectoryHandling;

class AuslesenDatensatz extends DirectoryHandling
{
    /**
     * @var string $info
     */
    private string $info = '';
    /**
     * @var array $datensaetze
     */
    private array $datensaetze = array();

    /**
     * @param string|null $path
     * @param string|null $file
     * @throws ErrorInTextspeichern
     */
    public function __construct(protected ?string $path = NULL, protected ?string $file = NULL)
    {
        parent::__construct($path, $file);
        parent::getIsTrue() ?: throw new ErrorInTextspeichern('kein File zum Auslesen');
        $this->auslesenDatensaetze();
        $_SESSION['count'] = max(0, count($this->datensaetze) - 1);
    }

    /**
     * @return void
     * @throws ErrorInTextspeichern
     */
    private function auslesenDatensaetze(): void
    {
        $content = file_get_contents($this->tothefile);

        if ($content === false) {
            throw new ErrorInTextspeichern('Fehler beim Lesen der Datei!');
        }
        $data = json_decode($content, true);
        //json_last_error() gibt einen Fehlercode zurück (eine Zahl).
        //JSON_ERROR_NONE bedeutet: kein Fehler.
        //eine verständliche Textbeschreibung des Fehlers zurück.
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new ErrorInTextspeichern('JSON ungültig: ' . json_last_error_msg());
        }
        if (!is_array($data)) {
            throw new ErrorInTextspeichern('JSON hat keine gültige Array-Struktur!');
        }

        $this->datensaetze = $data;
    }

    /**
     * @return array
     * @throws ErrorInTextspeichern
     */
    public function getDatensatz(): array
    {
        $_SESSION['index'] = $_SESSION['index'] ?? 0;
        $index = $_SESSION['index'];

        if (!isset($this->datensaetze[$index])) {
            throw new ErrorInTextspeichern('Keine Datensätze vorhanden!');
        }
        return $this->datensaetze[$index];
    }

    /**
     * @return void
     */
    public function setNextDatensatz(): void
    {
        ($_SESSION['index']) >= $_SESSION['count'] ?: $_SESSION['index']++;
    }

    /**
     * @return void
     */
    public function setBackDatensatz(): void
    {
        ($_SESSION['index']) <= 0 ?: $_SESSION['index']--;
    }

    /**
     * @return void
     * @throws ErrorInTextspeichern
     */
    public function setDelDatensatz(): void
    {
        $index = $_SESSION['index'];
        if (!isset($this->datensaetze[$index])) {
            throw new ErrorInTextspeichern('Ungültiger Index zum Löschen!');
        }
        array_splice($this->datensaetze, $index, 1);
        $del = file_put_contents($this->tothefile, json_encode($this->datensaetze), LOCK_EX);
        $this->info = $del ? 'Ihr Datensatz wurde gelöscht' : 'Ihr Datensatz wurde nicht gelöscht';
        $_SESSION['index'] = 0;
    }

    /**
     * @return void
     */
    public function setAnfangDatensatz(): void
    {
        $_SESSION['index'] = 0;
    }

    /**
     * @return void
     */
    public function setEndDatensatz(): void
    {
        $_SESSION['index'] = $_SESSION['count'];
    }

    /**
     * @return array
     */
    public function getAllDatensaetze(): array
    {
        return $this->datensaetze;
    }

    /**
     * @return array
     * array_values() liefert alle Werte des Arrays array mit einem numerischen Index.
     */
    public function getAllDatensaetzeJson(): array
    {
        $datensaetzeNum = array();
        foreach ($this->datensaetze as $value) {
            $datensaetzeNum[] = array_values($value);
        }
        return $datensaetzeNum;
    }

    /**
     * @return string
     */
    public function getMeldung(): string
    {
        return $this->info;
    }
}