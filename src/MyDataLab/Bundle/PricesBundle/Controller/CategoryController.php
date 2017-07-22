<?php

namespace MyDataLab\Bundle\PricesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CategoryController extends Controller
{

    public function indexAction()
    {
        $this->get('my_data_lab_admin.breadcrumbs_builder')->build('my_data_lab_prices_category');
        return $this->render('MyDataLabPricesBundle:Category:index.html.twig');
    }

}
