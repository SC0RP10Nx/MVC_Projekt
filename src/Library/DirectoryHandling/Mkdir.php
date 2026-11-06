<?php
declare(strict_types=1);

namespace dateninjson\Library\DirectoryHandling;

use dateninjson\Exceptions\Verzeichniserstellung\ErrorInVerzeichnis;

class Mkdir extends DirectoryHandling
{
    /**
     * @var string $info
     */
    private string $info;
    private bool $erfolg = false;
    /**
     * @var string $VerzPath
     */
    private string $VerzPath;

    /**
     * @param string|null $zielPath
     * @param string|null $verzeichnisAnlegen
     * @throws ErrorInVerzeichnis
     */
    public function __construct(protected string|null $zielPath = NULL, protected string|null $verzeichnisAnlegen = NULL)
    {
        (!empty($verzeichnisAnlegen)) ?: throw new ErrorInVerzeichnis('Kein Verzeichnis angegeben!');
        parent ::__construct($zielPath);
        parent ::setExistsPath($zielPath.$verzeichnisAnlegen) ? throw new ErrorInVerzeichnis('Verzeichnis existiert schon!'):(parent ::getExistsPath() ?: throw new ErrorInVerzeichnis('Der angegebene Path ist nicht korrekt!'));
        parent ::getIsWritable() ?: throw new ErrorInVerzeichnis('Keine Schreibrechte vorhanden!');
        $this -> VerzPath = $zielPath . $this -> verzeichnisReg($verzeichnisAnlegen);
        $this -> anlegenVerzeichnis();
    }

    /**
     * @param string $param
     * @return string
     * @throws ErrorInVerzeichnis
     */
    private function verzeichnisReg(string $param): string
    {
        $pattern = '/^[0-9a-zA-Z_]+$/';
        preg_match($pattern, $param, $matches);
        ($matches[ 0 ]) ?? throw new ErrorInVerzeichnis('Bitte nur Buchstaben, Zahlen oder Unterstriche nutzen! Keine Umlaute,Leerzeichen oder Sonderzeichen nutzen! ');
        return $matches[ 0 ];
    }

    /**
     * @return void
     */
    private function anlegenVerzeichnis():void
    {
        $this->erfolg = @mkdir($this -> VerzPath, 0777, true);
        $this->info = $this->erfolg ? 'Verzeichnis wurde erstellt' :'Verzeichnis wurde nicht erstellt';
    }

    /**
     * @return string
     */
    public function getMeldung(): string
    {
        return $this -> info ?? '';
    }
    public function getErfolg(): bool
    {
        return $this -> erfolg;
    }

}