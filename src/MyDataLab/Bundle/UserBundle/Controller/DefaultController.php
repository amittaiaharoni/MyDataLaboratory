<?php

namespace MyDataLab\Bundle\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{

    public function indexAction()
    {
        return $this->render('MyDataLabUserBundle:Default:index.html.twig');
    }

    public function accountAction()
    {

        $this->get('my_data_lab_admin.breadcrumbs_builder')->build('my_data_lab_user_account');
        return $this->render('MyDataLabUserBundle:Default:account.html.twig');
    }

    public function invoiceAction()
    {

        $this->get('my_data_lab_admin.breadcrumbs_builder')->build('my_data_lab_user_invoice');
        return $this->render('MyDataLabUserBundle:Default:invoice.html.twig');
    }

}
