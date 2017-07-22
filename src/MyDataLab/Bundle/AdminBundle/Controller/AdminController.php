<?php

namespace MyDataLab\Bundle\AdminBundle\Controller;

use MyDataLab\Bundle\WidgetBundle\Controller\ControllerHasWidgets;

class AdminController extends ControllerHasWidgets
{

    private $parents = [
        'admin' => [
            'sortable1' => [
                'widgets' => [],
                'class' => 'connectedSortable col-lg-3',
            ],
            'sortable2' => [
                'widgets' => [],
                'class' => 'connectedSortable col-lg-9',
            ],
            'sortable3' => [
                'widgets' => [],
                'class' => 'connectedSortable col-lg-4',
            ],
            'sortable4' => [
                'widgets' => [],
                'class' => 'connectedSortable col-lg-4',
            ],
        ],
        'client' => [
            'sortable5' => [
                'widgets' => [],
                'class' => 'connectedSortable col-lg-3',
            ],
            'sortable6' => [
                'widgets' => [],
                'class' => 'connectedSortable col-lg-3',
            ],
            'sortable7' => [
                'widgets' => [],
                'class' => 'connectedSortable col-lg-6',
            ],
            'sortable8' => [
                'widgets' => [],
                'class' => 'connectedSortable col-lg-6'
            ],
            'sortable9' => [
                'widgets' => [],
                'class' => 'connectedSortable col-lg-6',
                'after' => 'competitors-header.html.twig',
            ],
            //the above shouldn't be connected to the below
            'sortable10' => [
                'widgets' => [],
                'class' => 'connectedSortable col-lg-4'
            ],
            'sortable11' => [
                'widgets' => [],
                'class' => 'connectedSortable col-lg-4'
            ],
            'sortable12' => [
                'widgets' => [],
                'class' => 'connectedSortable col-lg-4'
            ],
            'sortable13' => [
                'widgets' => [],
                'class' => 'connectedSortable col-lg-6'
            ],
            'sortable14' => [
                'widgets' => [],
                'class' => 'connectedSortable col-lg-6'
            ],
            'sortable15' => [
                'widgets' => [],
                'class' => 'connectedSortable col-lg-6'
            ],
            'sortable16' => [
                'widgets' => [],
                'class' => 'connectedSortable col-lg-6'
            ],
            'sortable17' => [
                'widgets' => [],
                'class' => 'connectedSortable col-lg-12'
            ],
        ],
    ];

    public function getWidgetParents()
    {
        $user = $this->getUser();
        if (!$user) {
            return [];
        }
        if ($user->hasRole('ROLE_ADMIN')) {
            return $this->parents['admin'];
        }
        return $this->parents['client'];
    }

    public function dashboardAction()
    {
        $this->get('my_data_lab_admin.breadcrumbs_builder')->build('my_data_lab_admin_dashboard');
        return $this->doAction([
                    'title' => \ucwords($this->get('translator')->trans('MY_DASHBOARD')),
        ]);
    }

}
