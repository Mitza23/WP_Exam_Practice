<?php

class Result implements JsonSerializable
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
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getResult(): string
    {
        return $this->result;
    }

    /**
     * @param string $result
     */
    public function setResult(string $result): void
    {
        $this->result = $result;
    }

    private int $id;
    private string $username;
    private string $result;

    /**
     * @param int $id
     * @param string $username
     * @param string $result
     */
    public function __construct(int $id, string $username, string $result)
    {
        $this->id = $id;
        $this->username = $username;
        $this->result = $result;
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}