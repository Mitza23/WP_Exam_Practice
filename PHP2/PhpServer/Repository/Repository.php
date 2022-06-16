<?php

 require_once '../Model/Question.php';
 require_once '../Model/Quiz.php';
require_once '../Model/Result.php';
class Repository
{
    private string $host = "127.0.0.1";
    private string $database = "quizzes";
    private string $username = "root";
    private string $password = "";
    private mysqli $connection;

    public function __construct(){
        $this->connection = new mysqli($this->host, $this->username, $this->password, $this->database);
        if ($this->connection->connect_error){
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    public function getAllQuestions(): array{
        $sql = "select * from `questions`";
        $statement = $this->connection->prepare($sql);
        $statement->execute();
        $statement->bind_result($id, $text, $correctAnswer, $wrongAnswer);

        $result = array();
        while ($statement->fetch()){
            $result[] = new Question($id, $text, $correctAnswer, $wrongAnswer);
        }
        $statement->close();
        return $result;
    }

    public function addQuizTest(string $title, string $listOfQuestions){
        $sql = "insert into `quizzes`(`title`, `listOfQuestions`) values(?, ?)";
        $statement = $this->connection->prepare($sql);
        $statement->bind_param("ss", $title, $listOfQuestions);
        $statement->execute();
        $statement->close();
    }

    public function getQuestionsForQuiz(string $title): array{
        $sql = "select * from `quizzes` where title=?";
        $statement = $this->connection->prepare($sql);
        $statement->bind_param("s", $title);
        $statement->execute();
        $statement->bind_result($id, $title, $questionList);

        $questions = array();
        $quiz = new Quiz(-1, "", "");
        while ($statement->fetch()){
            $quiz = new Quiz($id, $title, $questionList);
        }
        if ($quiz->getId() == -1)
            return $questions;
        $statement->close();

        $questionListIds = explode(",", $questionList);
        foreach ($questionListIds as $questionId){
            $question = new Question(-1, "", "", "");
            $sql = "select * from `questions` where id=?";
            $statement = $this->connection->prepare($sql);
            $currentId = (int) $questionId;
            $statement->bind_param("i", $currentId);
            $statement->execute();
            $statement->bind_result($id, $text, $correctAnswer, $wrongAnswer);

            while ($statement->fetch()){
                $question = new Question($id, $text, $correctAnswer, $wrongAnswer);
            }
            if ($question->getId() != -1)
                $questions[] = $question;
            $statement->close();
        }
        return $questions;
    }

    public function addResult(string $username, int $result){
        $sql = "insert into `results`(`username`, `result`) values(?, ?)";
        $statement = $this->connection->prepare($sql);
        $statement->bind_param("si", $username, $result);
        $statement->execute();
        $statement->close();
    }

    public function submitAnswers(string $answers, string $title, string $username): int
    {
        $questions = $this->getQuestionsForQuiz($title);
        error_log($answers);
        error_log($title);
        error_log($username);
        $correctAnswers = 0;


        $givenAnswers = explode(",", $answers);

        foreach ($givenAnswers as $answer){
            error_log($answer);
        }

        foreach ($questions as $question){
            error_log(json_encode($question));
        }
        if (count($questions) != count($givenAnswers)){
            error_log("Somethign went wrong");
            return -1;
        }
        for ($i = 0; $i < count($questions); $i++){
            error_log($questions[$i]->getCorrectAnswer());
            error_log($givenAnswers[$i]);
            if (strcmp($questions[$i]->getCorrectAnswer(), $givenAnswers[$i]) == 0){
                $correctAnswers += 1;
            }
        }

        $this->addResult($username, $correctAnswers);
        return $correctAnswers;
    }
}