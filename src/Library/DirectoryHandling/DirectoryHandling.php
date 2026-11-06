<?php

namespace dateninjson\Library\DirectoryHandling;

class DirectoryHandling
{
    /**
     * @var string $tothefile
     */
    protected string $tothefile = '';

    /**
     * @param string|null $path
     * @param string|null $file
     */
    public function __construct(protected string|null $path = null, protected string|null $file = null)
    {
        //rtrim entfernt alle abschließenden Slashs (/ oder \) vom Pfad
        $this->tothefile = rtrim($path ?? '', DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $this->file ?? '';
    }

    /**
     * @return bool
     */
    public function getIsTrue(): bool
    {
        if (!$this->getExistsPath()) return false;
        if (!$this->getExistsFile()) return false;
        if (!$this->getIsWritable()) return false;
        return $this->getIfNotEmpty();
    }

    /**
     * @return bool
     */
    public function getExistsPath(): bool
    {
        return is_dir($this->path);
    }

    /**
     * @return bool
     */
    public function getExistsFile(): bool
    {
        return file_exists($this->tothefile);
    }

    /**
     * @return bool
     */
    public function getIfNotEmpty(): bool
    {
        return file_exists($this->tothefile) && filesize($this->tothefile) > 0;
    }

    /**
     * @return bool
     */
    public function getIsWritable(): bool
    {
        return is_writable($this->path);
    }

    /**
     * @return string
     */
    public function getToTheFile(): string
    {
        return $this->tothefile;
    }

    /**
     * @params string $path
     * @return bool
     */
    public function setExistsPath(string $path): bool
    {
        return is_dir($path);
    }
}