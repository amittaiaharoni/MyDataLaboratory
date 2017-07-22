<?php

namespace MyDataLab\Bundle\WordingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{

    public function indexAction()
    {
        $this->get('my_data_lab_admin.breadcrumbs_builder')->build('my_data_lab_wording_homepage');
        return $this->render('MyDataLabWordingBundle:Default:index.html.twig');
    }

    public function dashboardAction()
    {
        $this->get('my_data_lab_admin.breadcrumbs_builder')->build('my_data_lab_wording_dashboard');
        return $this->render('MyDataLabWordingBundle:Default:dashboard.html.twig');
    }

    public function keywordsListAction()
    {
        $this->get('my_data_lab_admin.breadcrumbs_builder')->build('my_data_lab_wording_keywords_list');
        return $this->render('MyDataLabWordingBundle:Default:keywords-list.html.twig');
    }
    public function productAnalysisAction()
    {
        $this->get('my_data_lab_admin.breadcrumbs_builder')->build('my_data_lab_wording_product_analysis');
        return $this->render('MyDataLabWordingBundle:Default:product-analysis.html.twig');
    }

}
