<?php

namespace A3020\FileReport\Statistics\Files\Result;

class FilesByTypeResult
{
    /** @var string */
    private $type;

    /** @var int */
    private $numberOfFiles;

    /**
     * @param string $type
     * @param int $numberOfFiles
     */
    public function __construct($type, $numberOfFiles)
    {
        $this->type = $type;
        $this->numberOfFiles = $numberOfFiles;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getNumberOfFiles()
    {
        return $this->numberOfFiles;
    }
}
