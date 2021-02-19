<?php

namespace A3020\FileReport\Result;

use Concrete\Core\File\File;

class BigImage
{
    /** @var int */
    private $fileId;
    private $width;
    private $height;
    private $fileName;
    private $url;

    /**
     * @param string $fileId
     * @param $width
     * @param $height
     * @param string $fileName
     * @param $url
     */
    public function __construct($fileId, $width, $height, $fileName, $url)
    {
        $this->fileId = $fileId;
        $this->width = $width;
        $this->height = $height;
        $this->fileName = $fileName;
        $this->url = $url;
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
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @return int
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->fileName;
    }

    public function getUrl()
    {
        return $this->url;
    }
}
