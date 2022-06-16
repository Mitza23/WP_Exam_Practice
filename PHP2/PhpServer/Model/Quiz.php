<?php

class Quiz implements JsonSerializable
{
    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getListOfQuestions(): string
    {
        return $this->listOfQuestions;
    }

    /**
     * @param string $listOfQuestions
     */
    public function setListOfQuestions(string $listOfQuestions): void
    {
        $this->listOfQuestions = $listOfQuestions;
    }
    private int $id;
    private string $title;
    private string $listOfQuestions;

    /**
     * @param int $id
     * @param string $title
     * @param string $listOfQuestions
     */
    public function __construct(int $id, string $title, string $listOfQuestions)
    {
        $this->id = $id;
        $this->title = $title;
        $this->listOfQuestions = $listOfQuestions;
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}