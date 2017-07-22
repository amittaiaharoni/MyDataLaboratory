<?php

namespace MyDataLab\Bundle\CatalogsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProductController extends Controller
{

    public function topAction()
    {
        $this->get('my_data_lab_admin.breadcrumbs_builder')->build('my_data_lab_catalog_product_top');
        return $this->render('MyDataLabCatalogsBundle:Product:top.html.twig');
    }

    public function missingAction()
    {
        $this->get('my_data_lab_admin.breadcrumbs_builder')->build('my_data_lab_catalog_product_missing');
        return $this->render('MyDataLabCatalogsBundle:Product:missing.html.twig');
    }

    public function exclusiveAction()
    {
        $this->get('my_data_lab_admin.breadcrumbs_builder')->build('my_data_lab_catalog_product_exclusive');
        return $this->render('MyDataLabCatalogsBundle:Product:exclusive.html.twig');
    }

}
