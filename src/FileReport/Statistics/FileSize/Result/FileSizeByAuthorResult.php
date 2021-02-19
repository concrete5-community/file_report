<?php

namespace A3020\FileReport\Statistics\FileSize\Result;

class FileSizeByAuthorResult
{
    /** @var string */
    private $author;

    /** @var int */
    private $fileSize;

    /**
     * @param string $author
     * @param int $fileSize
     */
    public function __construct($author, $fileSize)
    {
        $this->author = $author;
        $this->fileSize = $fileSize;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function getFileSize()
    {
        return $this->fileSize;
    }
}
