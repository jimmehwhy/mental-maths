Feature: Quiz
  As a user
  I need to be able to take a Quiz

@alice(User)
Scenario: A user can take a new quiz
  Given I am user "Tess"
  And I am on the "quiz" page
  When I start a new quiz
  Then I see the "new quiz options" page

@reset-schema
Scenario: A user can choose to randomize questions
  Given I am user "Tess"
  And I have started a new quiz
  When I choose "randomized" questions
  And I  submit the options
  Then a new quiz is started
  And the question number is "random"

Scenario: A user can choose to set a number to be tested
  Given I am user "Tess"
  And I have started a new quiz
  When I choose "training" questions with "7"
  And I  submit the options
  Then a new quiz is started
  And the question number is "7"

Scenario: A user can set the question time limit
  Given I am user "Tess"
  And I have started a new quiz
  When I set question time limit to "30" seconds
  And I  submit the options
  Then a new quiz is started
  And the question time limit is "30"

Scenario: A user can set the number of questions in the quiz
  Given I am user "Tess"
  And I have started a new quiz
  When I set number of questions to "5" questions
  And I  submit the options
  Then a new quiz is started
  And the number of questions are "5"

Scenario: A user can submit an answer
  Given I am user "Tess"
  And I am playing a new quiz
  When I input an answer
  And I press submit
  Then I see the next question

#  this should be changed to automatically moving on to the next question after the time
#   limit, and interesting example of why devs find it difficult to test own code,
#  as laziness means we'll take the easiest
#Scenario: If a user answers a question after the time limit
#  they are shown the next question
#  Given I am user "Tess"
#  And I am playing a new quiz
#  When I wait for 40 seconds
#  And I input an answer
#  And I press submit
#  Then I see the next question

Scenario: A user is automatically moved on to the next question after the time limit expires
  Given I am user "Tess"
  And I am playing a new quiz with 10 second time limit
  And I am on "question 1"
  When I wait for 11 seconds
  Then I am on "question 2"

Scenario: A user can finish the test
  Given I am user "Tess"
  And I am playing a new quiz with 10 questions
  And I am on "question 10"
  When I input an answer
  And I press submit
  Then I have finished the quiz
  And I am on the "quiz complete" page

Scenario: A user is shown the quiz results when the quiz complete
  Given I am user "Tess"
  And I am on the "quiz complete" page
  Then I can see the quiz score