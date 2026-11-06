<?php
declare(strict_types=1);

namespace dateninjson\Library\DirectoryHandling;

use dateninjson\Exceptions\Verzeichniserstellung\ErrorInVerzeichnis;

class VerzeichnisAuslesen extends DirectoryHandling
{
    /**
     * @param string|null $dirpath
     * @return array
     * @throws ErrorInVerzeichnis
     */
    public function getVerzeichnis(string|null $dirpath = NULL): array
    {
        parent::__construct($dirpath);
        parent::getExistsPath() ?: throw new ErrorInVerzeichnis('Der angegebene Path ist nicht korrekt!');

        //GLOB_ONLYDIR--->Nur Verzeichnisse zurückgeben, die dem Pattern entsprechen
         return array_map('basename', glob($dirpath . '*', GLOB_ONLYDIR));
    }
}
/*
 foreach (scandir($dirpath) as $file) {
  if ($file === ".." or $file === "." or !is_dir($dirpath)) continue;

    echo "$file\n";
}
$files = array_values(array_diff(scandir($dirpath), ['.','..']));
 */