<?php

namespace Why\MentalMathsBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Quiz
 *
 * @ORM\Table(name="quiz")
 * @ORM\Entity(repositoryClass="Why\MentalMathsBundle\Repository\QuizRepository")
 */
class Quiz
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
     * @ORM\OneToMany(targetEntity="Question", mappedBy="quiz", cascade={"persist"})
     */
    private $questions;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    /**
     * @var string
     *
     * @ORM\Column(name="user", type="string", length=255)
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="Answer", mappedBy="quiz", cascade={"persist"})
     */
    private $answers;

    /**
     * @var Integer
     *
     * @ORM\Column(name="current_question", type="integer")
     */
    private $current_question;

    public function __construct() {
        $this->questions = new ArrayCollection();
        $this->answers = new ArrayCollection();

        $this->current_question = 0;
        $this->setCreated(new \DateTime());
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
     * @return Question
     */
    public function getCurrentQuestion()
    {
        return $this->current_question <= $this->questions->count() ?
            $this->questions[$this->current_question] :
            null ;
    }

    /**
     * @param Integer $answer
     * @param Float $time
     */
    public function answerCurrentQuestion($answer, $time)
    {
        $this->answers->get($this->current_question)
            ->setAnswer($answer)
            ->setTime($time);
        $this->current_question++;
    }

    /**
     * Set questions
     *
     * @param [] $questions
     * @return Quiz
     */
    public function setQuestions($questions)
    {
        foreach($questions as $question) {
            $this->addQuestion($question);
        }

        return $this;
    }

    /**
     * @param Question $question
     */
    public function addQuestion($question){
        $question->setQuiz($this);
        $this->questions[] = $question;

        $this->answers[] = new Answer($this);
    }

    /**
     * @param Integer $index
     * @return Question|null
     */
    public function getQuestion($index) {
        return $this->questions->get($index);
    }

    /**
     * Get questions
     *
     * @return ArrayCollection
     */
    public function getQuestions()
    {
        return $this->questions;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Quiz
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set user
     *
     * @param string $user
     * @return Quiz
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return string 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set answers
     *
     * @param string $answers
     * @return Quiz
     */
    public function setAnswers($answers)
    {
        $this->answers = $answers;

        return $this;
    }

    /**
     * Get answers
     *
     * @return string 
     */
    public function getAnswers()
    {
        return $this->answers;
    }

    /**
     * @return int
     */
    public function getQuestionCount()
    {
        return $this->questions->count();
    }

    public function isComplete()
    {
        return $this->current_question == $this->getQuestionCount();
    }

    public function getResults()
    {
        $score = 0;

        $results = [];

        /**
         * @var Answer $answer
         */
        foreach($this->answers as $index => $answer) {
            $correct = $answer->getAnswer() === $this->getQuestion($index)->getAnswer() ? true : false ;

            $results[$index] = [
                'answer' => $answer->getAnswer(),
                'actual_answer' => $this->getQuestion($index)->getAnswer(),
                'correct' => $correct,
                'speed' => $answer->getTime()
            ];

            if($correct === true) $score++;
        }

        $results['score'] = ($score * 100) / $this->questions->count();

        return $results;
    }
}
