<?php
use Why\MentalMathsBundle\Entity\Question;
use Why\MentalMathsBundle\Entity\Quiz;

/**
 * Created by PhpStorm.
 * User: jimmehWhy
 * Date: 1/4/2017
 * Time: 7:41 PM
 */
class QuizTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Quiz
     */
    private $quiz;

    private $answers = [
        3, 4, 5, 6, 7, 0, 0, 0, 0, 0
    ];

    public function setUp() {
        $this->quiz = new Quiz();

        $questions = [
          Question::createWithFields(1, 2, '+', 3),
          Question::createWithFields(2, 2, '+', 4),
          Question::createWithFields(3, 2, '+', 5),
          Question::createWithFields(4, 2, '+', 6),
          Question::createWithFields(5, 2, '+', 7),
          Question::createWithFields(6, 2, '+', 8),
          Question::createWithFields(7, 2, '+', 9),
          Question::createWithFields(8, 2, '+', 10),
          Question::createWithFields(9, 2, '+', 11),
          Question::createWithFields(10, 2, '+', 12),
        ];

        $this->quiz->setQuestions($questions);
    }

    public function testItGetsTheFirstQuestion(){
        $question = $this->quiz->getCurrentQuestion();

        $this->assertEquals($question->getFieldOne(), 1);
        $this->assertEquals($question->getFieldTwo(), 2);
        $this->assertFalse($this->quiz->isComplete());
    }

    public function testItGetsTheNextQuestion(){
        $this->quiz->getCurrentQuestion();
        $this->quiz->answerCurrentQuestion(1, 1.00);

        $question = $this->quiz->getCurrentQuestion();
        $this->assertEquals($question->getFieldOne(), 2);
        $this->assertEquals($question->getFieldTwo(), 2);
    }

    public function testQuizEndsAfterFinalQuestion(){
        for($i = 0; $i < 10; $i++) {
            $this->quiz->getCurrentQuestion();
            $this->quiz->answerCurrentQuestion(1, 1.00);
        }

        $question = $this->quiz->getCurrentQuestion();
        $this->assertNull($question);
        $this->assertTrue($this->quiz->isComplete());
    }

    public function testTheAnswerIsRecordedCorrectly() {
        for($i = 0; $i < 10; $i++) {
            $this->quiz->getCurrentQuestion();
            $this->quiz->answerCurrentQuestion($this->answers[$i], 1.00);
        }

        $results = $this->quiz->getResults();

        $this->assertEquals($results[0]['answer'], 3);
    }

    public function testTheTimeIsRecordedCorrectly() {
        for($i = 0; $i < 10; $i++) {
            $this->quiz->getCurrentQuestion();
            $this->quiz->answerCurrentQuestion($this->answers[$i], 1.44);
        }

        $results = $this->quiz->getResults();

        $this->assertEquals($results[0]['speed'], 1.44);
    }

    public function testTheQuestionIsScoredCorrectly() {
        for($i = 0; $i < 10; $i++) {
            $this->quiz->getCurrentQuestion();
            $this->quiz->answerCurrentQuestion($this->answers[$i], 1.44);
        }

        $results = $this->quiz->getResults();

        $this->assertEquals($results[0]['correct'], true);
    }

    public function testItCalculatesTheCorrectTotalScore(){
        for($i = 0; $i < 10; $i++) {
            $this->quiz->getCurrentQuestion();
            $this->quiz->answerCurrentQuestion($this->answers[$i], 1.00);
        }

        $results = $this->quiz->getResults();

        $this->assertEquals($results['score'], 50);
    }
}
