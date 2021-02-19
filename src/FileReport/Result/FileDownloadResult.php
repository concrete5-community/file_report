<?php

namespace A3020\FileReport\Result;

use Concrete\Core\File\File;

class FileDownloadResult
{
    /** @var int */
    private $fileId;

    /** @var int */
    private $numberOfFiles;

    /**
     * @param string $fileId
     * @param int $numberOfDownloads
     */
    public function __construct($fileId, $numberOfDownloads)
    {
        $this->fileId = $fileId;
        $this->numberOfFiles = $numberOfDownloads;
    }

    public function getFileId()
    {
        return $this->fileId;
    }

    public function getFile()
    {
        return File::getByID($this->fileId);
    }

    public function getNumberOfFiles()
    {
        return $this->numberOfFiles;
    }
}
