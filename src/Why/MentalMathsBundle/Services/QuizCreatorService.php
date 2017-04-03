<?php
/**
 * Created by PhpStorm.
 * User: jimmehWhy
 * Date: 30/3/2017
 * Time: 5:16 PM
 */

namespace Why\MentalMathsBundle\Services;


use Why\MentalMathsBundle\Entity\Quiz;
use Why\MentalMathsBundle\Interfaces\QuestionGeneratorInterface;

class QuizCreatorService
{
    /**
     * @var QuestionGeneratorInterface
     */
    private $question_generator;

    public function __construct(QuestionGeneratorInterface $question_generator) {
        $this->question_generator = $question_generator;
    }

    /**
     * @param $number_of_questions
     * @param $max_question_value
     * @param null $set_value
     *
     * @return Quiz
     */
    public function createQuiz($number_of_questions, $max_question_value, $set_value = null){
        $quiz = new Quiz;

        while($quiz->getQuestionCount() < $number_of_questions) {
            $quiz->addQuestion($this->question_generator->generateQuestion($max_question_value, $set_value));
        }

        return $quiz;
    }
}