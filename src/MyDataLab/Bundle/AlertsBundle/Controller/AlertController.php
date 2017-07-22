<?php

namespace MyDataLab\Bundle\AlertsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AlertController extends Controller
{

    public function indexAction()
    {
        return $this->render('MyDataLabAlertsBundle:Alert:index.html.twig');
    }

    public function listAction()
    {
        $this->get('my_data_lab_admin.breadcrumbs_builder')->build('my_data_lab_alert_list');
        return $this->render('MyDataLabAlertsBundle:Alert:list.html.twig');
    }

    public function createAction()
    {
        $this->get('my_data_lab_admin.breadcrumbs_builder')->build('my_data_lab_alert_create');
        return $this->render('MyDataLabAlertsBundle:Alert:create.html.twig');
    }

    public function readAction()
    {
        $this->get('my_data_lab_admin.breadcrumbs_builder')->build('my_data_lab_alert_read');
        return $this->render('MyDataLabAlertsBundle:Alert:read.html.twig');
    }

}
