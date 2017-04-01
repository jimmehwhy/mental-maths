<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

    /**
     * @Given I am user :arg1
     */
    public function iAmUser($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Given I am on the :arg1 page
     */
    public function iAmOnThePage($arg1)
    {
        throw new PendingException();
    }

    /**
     * @When I start a new quiz
     */
    public function iStartANewQuiz()
    {
        throw new PendingException();
    }

    /**
     * @Then I see the :arg1 page
     */
    public function iSeeThePage($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Given I have started a new quiz
     */
    public function iHaveStartedANewQuiz()
    {
        throw new PendingException();
    }

    /**
     * @When I choose :arg1 questions
     */
    public function iChooseQuestions($arg1)
    {
        throw new PendingException();
    }

    /**
     * @When I  submit the options
     */
    public function iSubmitTheOptions()
    {
        throw new PendingException();
    }

    /**
     * @Then a new quiz is started
     */
    public function aNewQuizIsStarted()
    {
        throw new PendingException();
    }

    /**
     * @Then the question number is :arg1
     */
    public function theQuestionNumberIs($arg1)
    {
        throw new PendingException();
    }

    /**
     * @When I choose :arg1 questions with :arg2
     */
    public function iChooseQuestionsWith($arg1, $arg2)
    {
        throw new PendingException();
    }

    /**
     * @When I set question time limit to :arg1 seconds
     */
    public function iSetQuestionTimeLimitToSeconds($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then the question time limit is :arg1
     */
    public function theQuestionTimeLimitIs($arg1)
    {
        throw new PendingException();
    }

    /**
     * @When I set number of questions to :arg1 questions
     */
    public function iSetNumberOfQuestionsToQuestions($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then the number of questions are :arg1
     */
    public function theNumberOfQuestionsAre($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Given I am playing a new quiz
     */
    public function iAmPlayingANewQuiz()
    {
        throw new PendingException();
    }

    /**
     * @When I input an answer
     */
    public function iInputAnAnswer()
    {
        throw new PendingException();
    }

    /**
     * @When I press submit
     */
    public function iPressSubmit()
    {
        throw new PendingException();
    }

    /**
     * @Then I see the next question
     */
    public function iSeeTheNextQuestion()
    {
        throw new PendingException();
    }

    /**
     * @Given I am playing a new quiz with :arg1 second time limit
     */
    public function iAmPlayingANewQuizWithSecondTimeLimit($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Given I am on :arg1
     */
    public function iAmOn($arg1)
    {
        throw new PendingException();
    }

    /**
     * @When I wait for :arg1 seconds
     */
    public function iWaitForSeconds($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Given I am playing a new quiz with :arg1 questions
     */
    public function iAmPlayingANewQuizWithQuestions($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then I have finished the quiz
     */
    public function iHaveFinishedTheQuiz()
    {
        throw new PendingException();
    }

    /**
     * @Then I can see the quiz score
     */
    public function iCanSeeTheQuizScore()
    {
        throw new PendingException();
    }
}
