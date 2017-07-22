<?php

namespace MyDataLab\Bundle\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{

    public function extraAction()
    {
        return new Response((new \DateTime())->format('y/m/d H:i:s'));
    }

    public function indexAction()
    {
        if ($this->getUser()->hasRole('ROLE_ADMIN')) {
            $this->get('my_data_lab_admin.breadcrumbs_builder')->build('my_data_lab_admin_dashboard');
            return $this->render('MyDataLabAdminBundle:Admin:dashboard.html.twig');
        }
        $this->get('my_data_lab_admin.breadcrumbs_builder')->build('my_data_lab_admin_dashboard');
        return $this->render('MyDataLabDashboardBundle:Default:index.html.twig');
    }

    public function contactUsAction()
    {
        $this->get('my_data_lab_admin.breadcrumbs_builder')->build('my_data_lab_admin_contact_us');
        return $this->render('MyDataLabAdminBundle:Default:contact-us.html.twig');
    }

    public function dashboardAction()
    {
        $this->get('my_data_lab_admin.breadcrumbs_builder')->build('my_data_lab_admin_dashboard');
        return $this->render('MyDataLabAdminBundle:Admin:dashboard.html.twig');
    }

}
