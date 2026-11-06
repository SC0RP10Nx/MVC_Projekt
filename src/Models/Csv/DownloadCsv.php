<?php
namespace dateninjson\Models\Csv;

use dateninjson\Exceptions\CSV\ErrorInCsv;
use dateninjson\Library\DirectoryHandling\DirectoryHandling;


class DownloadCsv extends DirectoryHandling
{
    /**
     * @param string|null $path
     * @param string|null $file
     * @throws ErrorInCsv
     */
   public function __construct(?string $path = NULL, ?string $file = NULL)
    {
        parent::__construct($path, $file);
        parent::getExistsFile() ? header('Location: /csv/download') : throw new ErrorInCsv('CSV-File existiert nicht!');
    }
}