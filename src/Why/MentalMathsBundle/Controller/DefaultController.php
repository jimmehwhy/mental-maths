<?php

namespace Why\MentalMathsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('WhyMentalMathsBundle:Default:index.html.twig');
    }
}
