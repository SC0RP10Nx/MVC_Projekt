<?php
declare(strict_types=1);

namespace dateninjson\Models\Downloadimg;



use dateninjson\Library\DirectoryHandling\FileHandling;

class Upload extends FileHandling
{
    /**
     * @var string $info
     */
    private string $info;


    /**
     * @param string|null $targetDir
     * @param array|null $uploadtyp
     * @param string|null $exception
     * @param string|null $index
     */

    public function __construct(protected string|null $targetDir = NULL,
                                protected array|null  $uploadtyp = NULL,
                                protected string|null $exception = NULL,
                                protected string|null $index = NULL)
    {
        (!empty($index)) ?: throw new $exception('Kein index angegeben!');
        parent::__construct($index, $targetDir, $uploadtyp);
        parent::filesDefault();
        parent::checkUploadFile() ?: throw new $exception('kein file ausgewält!');
        parent::ifNotEmptyOrMax() ?: throw new $exception('Uploadfile leer oder Größe überschritten!');
        parent::zulassungsTyp() ?: throw new $exception('Der Zulassungstyp ist nicht korrekt!');
        parent::existsFile() ?: throw new $exception('filetmp existiert nicht!');
        parent::checkWritable() ?: throw new $exception('kein Schreibrechte vorhanden!');
        $this->fileUpload();
    }

    /**
     * @return void
     */
    private function fileUpload():void
    {
        if (@move_uploaded_file($this->files[3], $this->targetDir . '/' . $this->files[0])) {
            $this->info = 'Upload war erfolgreich';
        } else {
            $this->info = 'Upload war nicht erfolgreich!';
        }
    }

    /**
     * @return string
     */
    public function getMeldung(): string
    {
        return $this->info ?? '';
    }
}