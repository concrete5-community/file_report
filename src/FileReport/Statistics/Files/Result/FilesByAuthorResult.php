<?php

namespace A3020\FileReport\Statistics\Files\Result;

class FilesByAuthorResult
{
    /** @var string */
    private $author;

    /** @var int */
    private $numberOfFiles;

    /**
     * @param string $author
     * @param int $numberOfFiles
     */
    public function __construct($author, $numberOfFiles)
    {
        $this->author = $author;
        $this->numberOfFiles = $numberOfFiles;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function getNumberOfFiles()
    {
        return $this->numberOfFiles;
    }
}
