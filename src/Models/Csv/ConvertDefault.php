<?php
declare(strict_types=1);

namespace dateninjson\Models\Csv;

use dateninjson\Exceptions\CSV\ErrorInCsv;
use dateninjson\Library\DirectoryHandling\DirectoryHandling;


class ConvertDefault extends DirectoryHandling
{
    /**
     * @var array $datensatz
     */
    private array $datensatz = array();
    /**
     * @var array $jsonArray
     */
    private array $jsonArray;

    /**
     * @param string|null $filename
     * @param string|null $quelle
     * @param string|null $target
     * @param array|null $spname
     * @throws ErrorInCsv
     */
    public function __construct(protected string|null $filename = NULL, protected string|null $quelle = NULL, protected string|null $target = NULL, protected ?array $spname = NULL)
    {
        parent::__construct($quelle, $filename);
        parent::getExistsPath() ?: throw new ErrorInCsv('Quellpath stimmt nicht!');
        parent::getExistsFile() ?: throw new ErrorInCsv('Keine CSV vorhanden');
        $this->target = iconv("UTF-8", "CP1252", $target);
        $this->fileEinlesen();
        $this->setSpaltenName();
        $this->erstelleCsv();
    }

    /**
     * @return void
     */
    private function fileEinlesen():void
    {
        $this->jsonArray = json_decode(file_get_contents($this->quelle . $this->filename), true);
        foreach ($this->jsonArray as $value) {
            //Die Funktion array_values() ändert ein assoziatives Array (input) in
            // ein numerisch indiziertes Array.
            $this->datensatz[] = array_values($value);
        }
    }

    /**
     * @return void
     */
    private function setSpaltenName():void
    {
        //Die unshift Methode fügt die gegebenen Elemente am Anfang eines Arrays
        array_unshift($this->datensatz, array_values(empty($this->spname) ? array_keys($this->jsonArray[0]) : $this->spname));
    }

    /**
     * @return void
     */
    private function erstelleCsv():void
    {
        $file = @fopen($this->target, 'w') or die ('konnte die ' . $this->target . ' nicht öffnen');
        // Write BOM (byte-order mark)  character sequence to fix UTF-8 in Excel
        fputs($file, chr(0xEF) . chr(0xBB) . chr(0xBF));
        foreach ($this->datensatz as $value) {
            fputcsv($file, $value, ';');
        }
        fclose($file);
    }
}