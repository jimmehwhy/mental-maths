<?php
/**
 * Created by PhpStorm.
 * User: jimmehWhy
 * Date: 30/3/2017
 * Time: 5:20 PM
 */

namespace Why\MentalMathsBundle\Entity;

use Doctrine\Common\Proxy\Exception\InvalidArgumentException;
use Why\MentalMathsBundle\Interfaces\QuestionGeneratorInterface;

class MentalMathsQuestionGenerator implements QuestionGeneratorInterface
{
    private $operators = ['+', '-', '*', '/'];

    /**
     * @param int $max
     * @param null $set_value
     * @return Question
     */
    public function generateQuestion($max, $set_value = null)
    {
        $number_one = $this->getRandomInteger($max);
        $number_two = $this->getRandomInteger($max);
        $operator = $this->getRandomOperator();

        if($set_value) {
            if(is_numeric($set_value) && $set_value <= $max && $set_value >= 0) {
                $number_one = $set_value;
            } else if(in_array($set_value, $this->operators)) {
                $operator = $set_value;
            } else {
                throw new InvalidArgumentException("value \"" . $set_value . "\" is not a valid operator or number");
            }
        }

        return Question::createWithFields($number_one, $number_two, $operator, $this->determineAnswer($number_one, $number_two, $operator));
    }

    private function getRandomInteger($max) {
        return rand(1, $max);
    }

    private function getRandomOperator() {
        return $this->operators[rand(0, 3)];
    }

    private function determineAnswer($number_one, $number_two, $operator){
        switch($operator) {
            case '+' :
                return $number_one + $number_two;
            case '-' :
                return $number_one - $number_two;
            case '*' :
                return $number_one * $number_two;
            case '/' :
                return (integer) $number_one / $number_two;
        }

        throw new InvalidArgumentException("Invalid operator: \"" . $operator . "\"");
    }
}