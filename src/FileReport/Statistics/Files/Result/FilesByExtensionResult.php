<?php

namespace A3020\FileReport\Statistics\Files\Result;

class FilesByExtensionResult
{
    /** @var string */
    private $extension;

    /** @var int */
    private $numberOfFiles;

    /**
     * @param string $extension
     * @param int $numberOfFiles
     */
    public function __construct($extension, $numberOfFiles)
    {
        $this->extension = $extension;
        $this->numberOfFiles = $numberOfFiles;
    }

    public function getExtension()
    {
        return $this->extension;
    }

    public function getNumberOfFiles()
    {
        return $this->numberOfFiles;
    }
}
