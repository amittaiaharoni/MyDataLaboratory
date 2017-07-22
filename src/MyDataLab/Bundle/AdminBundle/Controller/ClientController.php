<?php

namespace MyDataLab\Bundle\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ClientController extends Controller
{

    public function dashboardAction()
    {
        $this->get('my_data_lab_admin.breadcrumbs_builder')->build('my_data_lab_admin_dashboard');

        return $this->render('MyDataLabAdminBundle:Client:dashboard.html.twig');
    }

    public function listAction()
    {
        $this->get('my_data_lab_admin.breadcrumbs_builder')->build('my_data_lab_admin_dashboard');

        return $this->render('MyDataLabAdminBundle:Client:list.html.twig');
    }

}
