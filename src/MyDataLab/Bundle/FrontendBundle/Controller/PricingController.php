<?php

namespace MyDataLab\Bundle\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PricingController extends Controller
{

    public function indexAction()
    {
        return $this->render('MyDataLabFrontendBundle:Pricing:index.html.twig');
    }

   
}
