<?php
header("Access-Control-Allow-Origin: *");
require '../service/UserService.php';
class UserController
{
    private UserService $userService;

    /**
     * @param string $servername
     * @param string $username
     * @param string $password
     * @param string $dbname
     */
    public function __construct(string $servername, string $username, string $password, string $dbname)
    {
        $this->userService = new UserService($servername, $username, $password, $dbname);
    }

    public function serve(): void
    {
        if (isset($_GET['action']) && !empty($_GET['action'])) {
            switch ($_GET['action']) {
                case "verify":
                    echo $this->userService->check($_GET['username'], $_GET['password']);
                    break;
                case "add":
                    echo $this->userService->addProfile($_GET['username'], $_GET['password']);
            }
        }
    }
}

$controller = new UserController("localhost", "root", "", "exam_practice_php");
$controller->serve();
