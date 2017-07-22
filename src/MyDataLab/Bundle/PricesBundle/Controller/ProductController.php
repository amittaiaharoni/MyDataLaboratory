<?php

namespace MyDataLab\Bundle\PricesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProductController extends Controller
{

    public function indexAction()
    {
        $this->get('my_data_lab_admin.breadcrumbs_builder')->build('my_data_lab_prices_product');
        return $this->render('MyDataLabPricesBundle:Product:index.html.twig');
    }

    public function singleAction()
    {
        $this->get('my_data_lab_admin.breadcrumbs_builder')->build('my_data_lab_prices_product_single');
        return $this->render('MyDataLabPricesBundle:Product:single.html.twig');
    }

}
