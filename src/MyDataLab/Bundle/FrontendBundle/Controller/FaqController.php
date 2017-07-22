<?php

namespace MyDataLab\Bundle\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class FaqController extends Controller
{
    public function indexAction()
    {
        return $this->render('MyDataLabFrontendBundle:Faq:index.html.twig');
    }
}
