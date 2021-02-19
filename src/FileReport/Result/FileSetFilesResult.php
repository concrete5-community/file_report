<?php

namespace A3020\FileReport\Result;

class FileSetFilesResult
{
    /** @var int */
    private $id;

    /** @var string */
    private $name;

    /** @var int */
    private $numberOfFiles;

    /** @var int */
    private $size;

    /**
     * @param int $id
     * @param string $name
     * @param int $numberOfFiles
     * @param int $size
     */
    public function __construct($id, $name, $numberOfFiles, $size)
    {
        $this->id = $id;
        $this->name = $name;
        $this->numberOfFiles = $numberOfFiles;
        $this->size = $size;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getNumberOfFiles()
    {
        return $this->numberOfFiles;
    }

    public function getSize()
    {
        return $this->size;
    }
}
