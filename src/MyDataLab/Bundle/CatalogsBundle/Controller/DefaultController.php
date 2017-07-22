<?php

namespace MyDataLab\Bundle\CatalogsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{

    public function indexAction()
    {
        return $this->render('MyDataLabCatalogsBundle:Default:index.html.twig');
    }

    public function dashboardAction()
    {
        /**
         * @todo js is broken
         */
        $this->get('my_data_lab_admin.breadcrumbs_builder')->build('my_data_lab_catalog_dashboard');
        return $this->render('MyDataLabCatalogsBundle:Default:dashboard.html.twig');
    }

}
