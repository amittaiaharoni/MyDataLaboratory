<?php

namespace MyDataLab\Bundle\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DatabaseController extends Controller
{

    public function dashboardAction()
    {

        //js not working
        $this->get('my_data_lab_admin.breadcrumbs_builder')->build('my_data_lab_admin_dashboard');

        return $this->render('MyDataLabAdminBundle:Database:dashboard.html.twig');
    }

    public function productListAction()
    {

        $this->get('my_data_lab_admin.breadcrumbs_builder')->build('my_data_lab_admin_dashboard');

        return $this->render('MyDataLabAdminBundle:Database:product-list.html.twig');
    }

    public function websiteListAction()
    {

        $this->get('my_data_lab_admin.breadcrumbs_builder')->build('my_data_lab_admin_dashboard');

        return $this->render('MyDataLabAdminBundle:Database:website-list.html.twig');
    }

}
