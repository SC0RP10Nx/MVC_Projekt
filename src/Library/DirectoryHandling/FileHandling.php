<?php
declare(strict_types=1);

namespace dateninjson\Library\DirectoryHandling;

class FileHandling
{
    /**
     * @var array|null $files
     */
    protected ?array $files = array();


    /**
     * @param string|null $index
     * @param string|null $targetDirPath
     * @param array|null $fileZulassungstyp
     */

    public function __construct(protected string|null $index = NULL, protected string|null $targetDirPath = NULL, protected array|null $fileZulassungstyp = NULL)
    {
    }

    /**
     * @return void
     */
    protected function filesDefault():void
    {
        $this->files[] = $_FILES[$this->index]['name'];
        $this->files[] = $_FILES[$this->index]['size'];
        $this->files[] = $_FILES[$this->index]['type'];
        $this->files[] = $_FILES[$this->index]['tmp_name'];
    }

    /**
     * @return void
     */
    protected function filesErweitert():void
    {
        $this->files[] = $_FILES[$this->index]['name'][0];
        $this->files[] = $_FILES[$this->index]['size'][0];
        $this->files[] = $_FILES[$this->index]['type'][0];
        $this->files[] = $_FILES[$this->index]['tmp_name'][0];
    }

    /**
     * @return bool
     *
     */
    protected function zulassungsTyp(): bool
    {
        return in_array($this->files[2], $this->fileZulassungstyp);
    }

    /**
     * @return bool
     *
     */
    protected function ifNotEmptyOrMax(): bool
    {
        return (!empty ($this->files[1]) && $this->files[1] < intval(ini_get('upload_max_filesize')) * 1000000);
    }

    /**
     * @return bool
     */
    protected function existsFile(): bool
    {
        return is_uploaded_file($this->files[3]);
    }

    /**
     * @return bool
     *
     */
    protected function checkWritable(): bool
    {
        return is_writable($this->targetDirPath);
    }

    /**
     * @return bool
     */
    protected function checkUploadFile(): bool
    {
        return !empty($this->files[0]);
    }

    /**
     * @return bool
     */
    protected function checkUploadFileExists(): bool
    {
        return !file_exists($this->targetDirPath . '/' . $this->files[0]);
    }
//*********Upload als Array

    /**
     * @param string $filetype
     * @return bool
     */
    protected function zulassungsTypArray(string $filetype): bool
    {
        return in_array($filetype, $this->fileZulassungstyp);
    }

    /**
     * @param int $filesize
     * @return bool
     */
    protected function ifNotEmptyOrMaxArray(int $filesize): bool
    {
        return (!empty ($filesize) && $filesize < intval(ini_get('upload_max_filesize')) * 1000000);
    }

    /**
     * @param string $filetmp
     * @return bool
     */
    protected function existsFileArray(string $filetmp): bool
    {
        return is_uploaded_file($filetmp);
    }

    /**
     * @param string $filename
     * @return bool
     */
    protected function checkUploadFileExistsArray(string $filename): bool
    {
        return !file_exists($this->targetDirPath . '/' . $filename);
    }
}