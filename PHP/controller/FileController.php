<?php
header("Access-Control-Allow-Origin: *");
require '../service/FileService.php';

class FileController
{
    private FileService $fileService;

    /**
     * @param string $servername
     * @param string $username
     * @param string $password
     * @param string $dbname
     */
    public function __construct(string $servername, string $username, string $password, string $dbname)
    {
        $this->fileService = new FileService($servername, $username, $password, $dbname);
    }

    public function serve(): void
    {
        if (isset($_GET['action']) && !empty($_GET['action'])) {
            switch ($_GET['action']) {
                case "getAll":
                    echo $this->fileService->getAll();
                    break;

                case "getPage":
                    $step = $_GET['step'];
                    $userid = $_GET['userid'];
                    echo $this->fileService->getPage($step, $userid);
                    break;

                case "add":
                    $name = $_GET['step'];
                    $path = $_GET['path'];
                    $size = $_GET['size'];
                    $userid = $_GET['userid'];
                    echo $this->fileService->add($userid, $name, $path, $size);
                    break;
            }
        }
    }
}

$controller = new FileController("localhost", "root", "", "exam_practice_php");
$controller->serve();
