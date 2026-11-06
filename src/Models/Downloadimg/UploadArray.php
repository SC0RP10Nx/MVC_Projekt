<?php
declare(strict_types=1);

namespace dateninjson\Models\Downloadimg;



use dateninjson\Library\DirectoryHandling\FileHandling;

class UploadArray extends FileHandling
{
    /**
     * @var array
     */
    private array $info=array();

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
        parent::checkWritable() ?: throw new $exception('kein Schreibrechte vorhanden!');

        //echo $this->filename[0];
        for ($i = 0; $i < count($this->files[0]); $i++) {
            $this->info[$i] = '';
            if (parent::ifNotEmptyOrMaxArray($this->files[1][$i])) {
                if (parent::zulassungsTypArray($this->files[2][$i])) {
                    if (parent::existsFileArray($this->files[3][$i])) {
                        if (parent::checkUploadFileExistsArray($this->files[0][$i])) {
                            $this->fileUpload($this->files[3][$i], $this->files[0][$i],$i);
                        } else {
                            $this->info[$i] .= $this->files[0][$i] . ' existiert schon!';
                        }
                    } else {
                        $this->info[$i] .= 'filetmp ' . $this->files[3][$i] . ' existiert nicht!';
                    }
                } else {
                    $this->info[$i] .= 'Der Zulassungstyp: ' . $this->files[2][$i] . ' ist nicht korrekt!';
                }
            } else {

                $this->info[$i] .= 'Uploadfile: ' . $this->files[0]/[$i] . ' leer oder Größe überschritten!';
            }
        }
    }

    /**
     * @param string $filetmp
     * @param string $filename
     * @param int $i
     * @return void
     */
    private function fileUpload(string $filetmp, string $filename,int $i):void
    {
        if (@move_uploaded_file($filetmp, $this->targetDir . '/' . $filename)) {
            $this->info[$i] = $filename.': Upload war erfolgreich';
        } else {
            $this->info[$i] = $filename.': Upload war nicht erfolgreich!';
        }
    }

    /**
     * @return array|string
     */
    public function getMeldung(): array|string
    {
        return $this->info ?? '';
    }
}