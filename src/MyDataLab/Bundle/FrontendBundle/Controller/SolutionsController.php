<?php

namespace MyDataLab\Bundle\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SolutionsController extends Controller
{

    public function indexAction()
    {
        return $this->render('MyDataLabFrontendBundle:Solutions:index.html.twig');
    }

    public function pricingIntelligenceAction()
    {
        return $this->render('MyDataLabFrontendBundle:Solutions:pricing-intelligence.html.twig');
    }

    public function catalogAnalysisAction()
    {
        return $this->render('MyDataLabFrontendBundle:Solutions:catalog-analysis.html.twig');
    }
    public function marketSurveyAction()
    {
        return $this->render('MyDataLabFrontendBundle:Solutions:market-survey.html.twig');
    }

}
