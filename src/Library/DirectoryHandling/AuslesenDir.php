<?php

namespace dateninjson\Library\DirectoryHandling;

use dateninjson\Exceptions\Verzeichniserstellung\ErrorInVerzeichnis;


class AuslesenDir extends DirectoryHandling
{
    /**
     * @param string|null $dirPath
     * @param string|null $reg
     * @throws ErrorInVerzeichnis
     */
    public function __construct(private ?string $dirPath = NULL, private ?string $reg = NULL)
    {
        parent::__construct($dirPath);
        parent::getExistsPath() ?: throw new ErrorInVerzeichnis('Der angegebene Path ist nicht korrekt!');
        $reg ?? throw new ErrorInVerzeichnis('Es fehlt der reguläre Ausdruck!');
    }

    /**
     * @return array
     */
    public function getAuslesenDir(): array
    {
        $dirArray = array();
        //GLOB_ONLYDIR--->Nur Verzeichnisse zurückgeben, die dem Pattern entsprechen
        $dirArray['imgName'] = array_map('basename', glob($this->dirPath . '/' . $this->reg, GLOB_BRACE));
        //glob---Gibt ein Array von Dateinamen oder Verzeichnissen zurück, das dem angegebenen Muster entspricht:
        $dirArray['ImgPath'] = glob($this->dirPath . '/' . $this->reg, GLOB_BRACE);
        $dirArray['ImgPath'] = str_replace(rtrim($_SERVER['DOCUMENT_ROOT'], '/'), '', $dirArray['ImgPath']);
        //mime_content_type — ermittelt den MIME-Typ des Inhalts einer Datei
        foreach ($dirArray['imgName'] as $item) {
            $dirArray['ImgTyp'][] = mime_content_type($this->dirPath . '/' . $item);
        }

        return $dirArray;
    }


}

