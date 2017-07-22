<?php

namespace MyDataLab\Bundle\ProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MyDataLabProductBundle:Default:index.html.twig');
    }
}
