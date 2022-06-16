<?php

class Question implements JsonSerializable
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
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText(string $text): void
    {
        $this->text = $text;
    }

    /**
     * @return string
     */
    public function getCorrectAnswer(): string
    {
        return $this->correctAnswer;
    }

    /**
     * @param string $correctAnswer
     */
    public function setCorrectAnswer(string $correctAnswer): void
    {
        $this->correctAnswer = $correctAnswer;
    }

    /**
     * @return string
     */
    public function getWrongAnswer(): string
    {
        return $this->wrongAnswer;
    }

    /**
     * @param string $wrongAnswer
     */
    public function setWrongAnswer(string $wrongAnswer): void
    {
        $this->wrongAnswer = $wrongAnswer;
    }
    private int $id;
    private string $text;
    private string $correctAnswer;
    private string $wrongAnswer;

    /**
     * @param int $id
     * @param string $text
     * @param string $correctAnswer
     * @param string $wrongAnswer
     */
    public function __construct(int $id, string $text, string $correctAnswer, string $wrongAnswer)
    {
        $this->id = $id;
        $this->text = $text;
        $this->correctAnswer = $correctAnswer;
        $this->wrongAnswer = $wrongAnswer;
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}