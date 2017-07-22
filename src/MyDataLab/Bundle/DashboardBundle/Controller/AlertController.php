<?php

namespace MyDataLab\Bundle\DashboardBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AlertController extends Controller
{

    public function indexAction()
    {
        return $this->render('MyDataLabDashboardBundle:Alert:index.html.twig');
    }

    public function listAction()
    {
        $this->get('my_data_lab_admin.breadcrumbs_builder')->build('my_data_lab_alert_list');
        return $this->render('MyDataLabDashboardBundle:Alert:list.html.twig');
    }

    public function createAction()
    {
        $this->get('my_data_lab_admin.breadcrumbs_builder')->build('my_data_lab_alert_create');
        return $this->render('MyDataLabDashboardBundle:Alert:create.html.twig');
    }

    public function readAction()
    {
        $this->get('my_data_lab_admin.breadcrumbs_builder')->build('my_data_lab_alert_read');
        return $this->render('MyDataLabDashboardBundle:Alert:read.html.twig');
    }

}
