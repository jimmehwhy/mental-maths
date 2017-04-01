<?php

namespace Why\MentalMathsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Question
 *
 * @ORM\Table(name="question")
 * @ORM\Entity(repositoryClass="Why\MentalMathsBundle\Repository\QuestionRepository")
 */
class Question
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="field_one", type="integer")
     */
    private $fieldOne;

    /**
     * @var int
     *
     * @ORM\Column(name="field_two", type="integer")
     */
    private $fieldTwo;

    /**
     * @var string
     *
     * @ORM\Column(name="operator", type="string", length=1)
     */
    private $operator;

    /**
     * @var int
     *
     * @ORM\Column(name="answer", type="integer")
     */
    private $answer;

    /**
     * @ORM\ManyToOne(targetEntity="Quiz", inversedBy="questions")
     * @ORM\JoinColumn(name="question_id", referencedColumnName="id")
     */
    private $quiz;

    public static function createWithFields($number_one, $number_two, $operator, $answer) {
        $question = new self;

        $question->setFieldOne($number_one);
        $question->setFieldTwo($number_two);
        $question->setOperator($operator);
        $question->setAnswer($answer);

        return $question;
    }

    /**
     * @return string
     */
    public function toString() {
        return $this->fieldOne . " " . $this->operator . " " . $this->fieldTwo . " = " . $this->answer;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set fieldOne
     *
     * @param integer $fieldOne
     * @return Question
     */
    public function setFieldOne($fieldOne)
    {
        $this->fieldOne = $fieldOne;

        return $this;
    }

    /**
     * Get fieldOne
     *
     * @return integer 
     */
    public function getFieldOne()
    {
        return $this->fieldOne;
    }

    /**
     * Set fieldTwo
     *
     * @param integer $fieldTwo
     * @return Question
     */
    public function setFieldTwo($fieldTwo)
    {
        $this->fieldTwo = $fieldTwo;

        return $this;
    }

    /**
     * Get fieldTwo
     *
     * @return integer 
     */
    public function getFieldTwo()
    {
        return $this->fieldTwo;
    }

    /**
     * Set operator
     *
     * @param string $operator
     * @return Question
     */
    public function setOperator($operator)
    {
        $this->operator = $operator;

        return $this;
    }

    /**
     * Get operator
     *
     * @return string 
     */
    public function getOperator()
    {
        return $this->operator;
    }

    /**
     * Set answer
     *
     * @param integer $answer
     * @return Question
     */
    public function setAnswer($answer)
    {
        $this->answer = $answer;

        return $this;
    }

    /**
     * Get answer
     *
     * @return integer 
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * @return mixed
     */
    public function getQuiz()
    {
        return $this->quiz;
    }

    /**
     * @param mixed $quiz
     */
    public function setQuiz($quiz)
    {
        $this->quiz = $quiz;
    }
}
