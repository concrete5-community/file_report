<?php

namespace A3020\FileReport\Result;

use Concrete\Core\File\File;

class BigFile
{
    /** @var int */
    private $fileId;
    private $fileSize;
    private $fileName;

    /**
     * @param string $fileId
     * @param int $fileSize
     * @param string $fileName
     */
    public function __construct($fileId, $fileSize, $fileName)
    {
        $this->fileSize = $fileSize;
        $this->fileName = $fileName;
    }

    public function getId()
    {
        return $this->fileId;
    }

    public function getFile()
    {
        return File::getByID($this->fileId);
    }

    /**
     * @return int
     */
    public function getSize()
    {
        return $this->fileSize;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->fileName;
    }
}
