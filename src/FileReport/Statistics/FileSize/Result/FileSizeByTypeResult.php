<?php

namespace A3020\FileReport\Statistics\FileSize\Result;

class FileSizeByTypeResult
{
    /** @var string */
    private $type;

    /** @var int */
    private $fileSize;

    /**
     * @param string $type
     * @param int $fileSize
     */
    public function __construct($type, $fileSize)
    {
        $this->type = $type;
        $this->fileSize = $fileSize;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getFileSize()
    {
        return $this->fileSize;
    }
}
