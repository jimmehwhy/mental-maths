<?php
use Why\MentalMathsBundle\Entity\MentalMathsQuestionGenerator;
use Why\MentalMathsBundle\Entity\Question;

/**
 * Created by PhpStorm.
 * User: jimmehWhy
 * Date: 30/3/2017
 * Time: 5:23 PM
 */
class MentalMathsQuestionGeneratorTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var MentalMathsQuestionGenerator
     */
    private $generator;

    private $number_range = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
    private $operator_range = ['/', '*', '+', '-'];

    public function setUp()
    {
        $this->generator = new MentalMathsQuestionGenerator();
    }

    public function testItCreatesARandomQuestion() {
        $question = $this->generator->generateQuestion(count($this->number_range));
        $this->assertNotNull($question);
    }

    public function testItCreatesCorrectRangeOfNumbersForFieldOneWhenRandom(){
        $question = $this->generator->generateQuestion(count($this->number_range));
        $this->assertContains($question->getFieldOne(), $this->number_range);
    }

    public function testItCreatesCorrectRangeOfNumbersForFieldTwoWhenRandom(){
        $question = $this->generator->generateQuestion(count($this->number_range));
        $this->assertContains($question->getFieldTwo(), $this->number_range);
    }

    public function testItCreatesCorrectRangeOfOperators(){
        $question = $this->generator->generateQuestion(count($this->number_range));
        $this->assertContains($question->getOperator(), $this->operator_range);
    }

    public function testAnswerIsCorrect(){
        $question = $this->generator->generateQuestion(count($this->number_range));
        $expected_answer = $this->calculateExpectedAnswer($question);
        $this->assertEquals($question->getAnswer(), $expected_answer);
    }

    public function testIfNumberIsSuppliedToQuestionFieldOneIsNumber(){
        $set_number = 5;
        $question = $this->generator->generateQuestion(count($this->number_range), $set_number);
        $this->assertEquals($question->getFieldOne(), $set_number);
    }

    public function testIfNumberIsSuppliedToQuestionFieldTwoIsRandom(){
        $set_number = 5;
        $question = $this->generator->generateQuestion(count($this->number_range), $set_number);
        $this->assertContains($question->getFieldTwo(), $this->number_range);
    }

    public function testIfOperatorIsSuppliedToQuestionOperatorIsOperator(){
        $set_operator = '+';
        $question = $this->generator->generateQuestion(count($this->number_range), $set_operator);
        $this->assertEquals($question->getOperator(), $set_operator);
    }

    /**
     * Note! This is replicated here, to make tests more readable, and to not rely on the
     * same unit of code for generation and verification!
     *
     * @param Question $question
     * @return int
     */
    private function calculateExpectedAnswer($question) {

        switch($question->getOperator()) {
            case '+' :
                return $question->getFieldOne() + $question->getFieldTwo();
            case '-' :
                return $question->getFieldOne() - $question->getFieldTwo();
            case '*' :
                return $question->getFieldOne() * $question->getFieldTwo();
            case '/' :
                return (integer) $question->getFieldOne() / $question->getFieldTwo();
        }

        throw new InvalidArgumentException("Invalid operator: \"" . $question->getOperator() . "\"");
    }
}