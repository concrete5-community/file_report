<?php

namespace A3020\FileReport\Statistics\FileSize\Result;

class FileSizeByExtensionResult
{
    /** @var string */
    private $extension;

    /** @var int */
    private $fileSize;

    /**
     * @param string $extension
     * @param int $fileSize
     */
    public function __construct($extension, $fileSize)
    {
        $this->extension = $extension;
        $this->fileSize = $fileSize;
    }

    public function getExtension()
    {
        return $this->extension;
    }

    public function getFileSize()
    {
        return $this->fileSize;
    }
}
