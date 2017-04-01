<?php
/**
 * Created by PhpStorm.
 * User: jimmehWhy
 * Date: 30/3/2017
 * Time: 5:17 PM
 */

namespace Why\MentalMathsBundle\Interfaces;

use Why\MentalMathsBundle\Entity\Question;


interface QuestionGeneratorInterface
{
    /**
     * @param Integer $max maximum value of a question
     * @return Question
     */
    public function generateQuestion($max);
}