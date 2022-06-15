<?php
header("Access-Control-Allow-Origin: *");
require '../entities/File.php';
class FileService
{
    private mysqli $connection;
    private string $servername;
    private string $username;
    private string $password;
    private string $dbname;

    private int $page;
    private int $results_per_page;
    private int $total_pages;

    /**
     * @param string $servername
     * @param string $username
     * @param string $password
     * @param string $dbname
     */
    public function __construct(string $servername, string $username, string $password, string $dbname)
    {
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;
        $this->results_per_page = 2;
        $this->page = 1;

        $this->connect();
        $query = "select *from files";
        $result = mysqli_query($this->connection, $query);
        $number_of_result = mysqli_num_rows($result);

        //determine the total number of pages available
        $this->total_pages = ceil ($number_of_result / $this->results_per_page);


        $this->disconnect();
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

    public function getAll(): bool|mysqli_result
    {
        $this->connect();
        $stmt = $this->connection->prepare(
            "SELECT * FROM files"
        );
        $stmt->execute();
        $result = $stmt->get_result();

        $this->disconnect();
        $echoArray = array();

        if ($result->num_rows > 0) {
            while ($row = mysqli_fetch_row($result)) {
                $echoArray[] = new File($row['id'], $row['userid'], $row['filename'], $row['filepath'], $row['size']);
            }
        } else {
            echo "0 results";
            return false;
        }

        return json_encode($echoArray);
    }

    public function getPage(int $step, int $userid): bool|string
    {
        $this->page = $step;
        $page_first_result = $this->page * $this->results_per_page;

        $query = "SELECT * FROM files where userid=" . $userid . " LIMIT " . $page_first_result . ',' . $this->results_per_page;

        $this->connect();
        $result = mysqli_query($this->connection, $query);

        $echoArray = array();
        while ($row = mysqli_fetch_array($result)) {
            $echoArray[] = new File($row['id'], $row['userid'], $row['filename'], $row['filepath'], $row['size']);
        }
        $this->disconnect();
        return json_encode($echoArray);
    }

    public function add(int $userid, string $filename, string $filepath, int $size): bool
    {
        $this->connect();

        $stmt = $this->connection->prepare(
            "INSERT INTO files (userid, filename, filepah, size) VALUES (?, ?, ?, ?)"
        );
        $stmt->bind_param("issi", $userid, $filename, $filepath, $size);
        $result = $stmt->execute();

        $this->disconnect();

        return $result;
    }
}
