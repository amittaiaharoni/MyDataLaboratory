<?php

namespace MyDataLab\Bundle\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{

    public function indexAction()
    {
        //js doesn't work
        $this->get('my_data_lab_admin.breadcrumbs_builder')->build('my_data_lab_admin_dashboard');

        return $this->render('MyDataLabAdminBundle:User:index.html.twig');
    }

}
