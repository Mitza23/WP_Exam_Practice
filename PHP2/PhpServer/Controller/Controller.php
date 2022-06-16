<?php

require_once '../Repository/Repository.php';
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

class Controller
{
    private Repository $repository;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    public function service(){
        $json = file_get_contents("php://input");
        $request = json_decode($json, true);
        if (isset($request['action'])){
            switch ($request['action']){
                case "displayQuestions":
		            echo json_encode($this->repository->getAllQuestions());
                    break;
                case "createNewQuiz":
		            $this->repository->addQuizTest($request['title'], $request['questions']);
                    break;
                case "getQuizQuestions":
                    echo json_encode($this->repository->getQuestionsForQuiz($request['title']));
                    break;
                case "submitResults":
                    error_log("I'm waiting man");
                    $this->repository->addResult($request['username'], (int) $request['result']);
                    break;
                case "submitAnswers":
                    echo $this->repository->submitAnswers($request['answers'], $request['title'], $request['username']);
                    break;
            }
        }
    }
}

$repository = new Repository();
$controller = new Controller($repository);
$controller->service();