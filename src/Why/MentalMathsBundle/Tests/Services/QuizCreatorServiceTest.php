<?php
use Why\MentalMathsBundle\Entity\MentalMathsQuestionGenerator;
use Why\MentalMathsBundle\Entity\Question;
use Why\MentalMathsBundle\Entity\Quiz;
use Why\MentalMathsBundle\Services\QuizCreatorService;

/**
 * Created by PhpStorm.
 * User: jimmehWhy
 * Date: 30/3/2017
 * Time: 5:22 PM
 */
class QuizCreatorServiceTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var QuizCreatorService
     */
    private $creator_service;

    public function setUp() {
        $this->creator_service = new QuizCreatorService(new MentalMathsQuestionGenerator());
    }

    public function testItCreatesSpecifiedNumberOfQuestions(){
        /**
         * @var Quiz $quiz
         */
        $quiz = $this->creator_service->createQuiz(10, 10);
        $this->assertCount(10, $quiz->getQuestions());
    }

    public function testIfSpecifiedNumberEachQuestionContainsNumber(){
        /**
         * @var Quiz $quiz
         */
        $quiz = $this->creator_service->createQuiz(10, 10, 9);

        /**
         * @var Question $question
         */
        foreach($quiz->getQuestions() as $question){
            $this->assertEquals(9, $question->getFieldOne());
        }
    }

    public function testIfSpecifiedOperatorEachQuestionContainsOperator(){
        /**
         * @var Quiz $quiz
         */
        $quiz = $this->creator_service->createQuiz(10, 10, '+');

        /**
         * @var Question $question
         */
        foreach($quiz->getQuestions() as $question){
            $this->assertEquals('+', $question->getOperator());
        }
    }
}