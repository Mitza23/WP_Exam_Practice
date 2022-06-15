<?php

use JetBrains\PhpStorm\ArrayShape;

class File
{
    public int $id;
    public string $userid;
    public string $filename;
    public string $filepath;
    public int $size;

    /**
     * @param int $id
     * @param string $userid
     * @param string $filename
     * @param string $filepath
     * @param int $size
     */
    public function __construct(int $id, string $userid, string $filename, string $filepath, int $size)
    {
        $this->id = $id;
        $this->userid = $userid;
        $this->filename = $filename;
        $this->filepath = $filepath;
        $this->size = $size;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }


    /**
     * @return string
     */
    public function getUserid(): string
    {
        return $this->userid;
    }

    /**
     * @param string $userid
     */
    public function setUserid(string $userid): void
    {
        $this->userid = $userid;
    }

    /**
     * @return string
     */
    public function getFilename(): string
    {
        return $this->filename;
    }

    /**
     * @param string $filename
     */
    public function setFilename(string $filename): void
    {
        $this->filename = $filename;
    }

    /**
     * @return string
     */
    public function getFilepath(): string
    {
        return $this->filepath;
    }

    /**
     * @param string $filepath
     */
    public function setFilepath(string $filepath): void
    {
        $this->filepath = $filepath;
    }

    /**
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * @param int $size
     */
    public function setSize(int $size): void
    {
        $this->size = $size;
    }

    #[ArrayShape(['id' => "int", 'userid' => "string", 'filename' => "string", 'filepath' => "string", 'size' => "string"])] public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'userid' => $this->userid,
            'filename' => $this->filename,
            'filepath' => $this->filepath,
            'size' => $this->size
        ];
    }

}
