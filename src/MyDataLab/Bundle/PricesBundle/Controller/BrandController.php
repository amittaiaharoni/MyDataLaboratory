<?php

namespace MyDataLab\Bundle\PricesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BrandController extends Controller
{

    public function indexAction()
    {
        $this->get('my_data_lab_admin.breadcrumbs_builder')->build('my_data_lab_prices_brand');
        return $this->render('MyDataLabPricesBundle:Brand:index.html.twig');
    }

}
