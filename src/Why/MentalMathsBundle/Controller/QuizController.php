<?php

namespace Why\MentalMathsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Why\MentalMathsBundle\Entity\Quiz;

class QuizController extends Controller
{
    public function indexAction(Request $request)
    {
        $data = array();
        /**
         * @var Form $form
         */
        $form = $this->createFormBuilder($data)
            ->add('questions', TextType::class)
            ->add('max-value', TextType::class)
            ->add('set-value', TextType::class)
            ->add('save', SubmitType::class, array('label' => 'Go!'))
            ->getForm();

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            $data = $form->getData();

            //create quiz and forward on to playing
            $quiz_generator = $this->get("why_mmaths_quiz_creator");
            $quiz = $quiz_generator->createQuiz($data['questions'], $data['max-value'], $data['set-value']);
            $quiz->setUser('this-user');


            $em = $this->get('doctrine.orm.default_entity_manager');
            $em->persist($quiz);
            $em->flush();

            return $this->redirectToRoute('why_mental_maths_quizpage', [
                'id' => $quiz->getId()
            ]);
        }

        return $this->render('WhyMentalMathsBundle:Quiz:index.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /*
    * @ParamConverter("quiz", class="WhyMentalMaths:Quiz")
    */
    public function quizAction(Quiz $quiz, Request $request)
    {
        $data = array();
        /**
         * @var Form $form
         */
        $form = $this->createFormBuilder($data)
            ->add('answer', TextType::class)
            ->add('save', SubmitType::class, array('label' => 'Submit'))
            ->getForm();

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            $data = $form->getData();

            $quiz->answerCurrentQuestion($data['answer'], 10.66);

            $em = $this->get('doctrine.orm.default_entity_manager');
            $em->persist($quiz);
            $em->flush();

            if($quiz->isComplete()) {
                return $this->redirectToRoute('why_mental_maths_quiz_complete', [
                    'id' => $quiz->getId()
                ]);
            }

            return $this->redirectToRoute('why_mental_maths_quizpage', [
                'id' => $quiz->getId()
            ]);
        }

        return $this->render('WhyMentalMathsBundle:Quiz:quiz.html.twig', [
            'quiz' => $quiz,
            'form' => $form->createView()
        ]);
    }

    /*
    * @ParamConverter("quiz", class="WhyMentalMaths:Quiz")
    */
    public function completeAction(Quiz $quiz) {
        return $this->render('WhyMentalMathsBundle:Quiz:complete.html.twig', [
            'results' => $quiz->getResults()
        ]);
    }
}
