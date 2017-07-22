<?php

namespace MyDataLab\Bundle\FrontendBundle\Controller;

use MyDataLab\Bundle\VendorsApiBundle\StubEntity\EbayItem;
use MyDataLab\Bundle\VendorsApiBundle\StubEntity\PriceMinisterItem;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{

    public function indexAction()
    {
        return $this->render('MyDataLabFrontendBundle:Default:index.html.twig');
    }

    public function subscriptionAction()
    {
        return $this->render('MyDataLabFrontendBundle:Default:subscription.html.twig');
    }

}
