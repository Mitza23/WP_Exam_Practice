<?php

header("Access-Control-Allow-Origin: *");

class UserService
{
    private mysqli $connection;
    private string $servername;
    private string $username;
    private string $password;
    private string $dbname;

    public function __construct(string $servername, string $username, string $password, string $dbname)
    {
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;
    }

    private function connect(): void
    {
        $this->connection = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    private function disconnect(): void
    {
        $this->connection->close();
    }

    public function check(string $username, string $password): int
    {
        $this->connect();
        $stmt = $this->connection->prepare(
            "SELECT * FROM users where username = ?"
        );
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if($row = $result->fetch_assoc()) {
            $saved_password = $row['password'];
            $return = -1;
            if($password == $saved_password) {
                $return = $row['id'];
            }
            $this->disconnect();
            return $return;
        }
        else
            $this->disconnect();
            return -1;
    }

    public function addProfile(string $username, string $password): int
    {
        $this->connect();
        $stmt = $this->connection->prepare(
            "INSERT INTO users(username, password) VALUES (?, ?)"
        );
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $this->disconnect();
        return $this->check($username, $password);
    }
}
