<?php

namespace MyDataLab\Bundle\LeadsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MyDataLabLeadsBundle:Default:index.html.twig');
    }
}
