<?php

namespace MyDataLab\Bundle\AdminBundle\Controller;

use MyDataLab\Bundle\WidgetBundle\Controller\ControllerHasWidgets;

class TurnoverController extends ControllerHasWidgets
{

    public function getWidgetParents()
    {
        return [
            'sortable18' => [
                'widgets' => [],
                'class' => 'connectedSortable col-lg-3',
            ],
            'sortable19' => [
                'widgets' => [],
                'class' => 'connectedSortable col-lg-3',
            ],
            'sortable20' => [
                'widgets' => [],
                'class' => 'connectedSortable col-lg-3',
            ],
            'sortable21' => [
                'widgets' => [],
                'class' => 'connectedSortable col-lg-3',
            ],
            'sortable22' => [
                'widgets' => [],
                'class' => 'connectedSortable col-lg-9',
            ],
            'sortable23' => [
                'widgets' => [],
                'class' => 'connectedSortable col-lg-3',
            ],
        ];
    }

    public function indexAction()
    {
        $groups = $this->getWidgetGroups();
        $this->get('my_data_lab_admin.breadcrumbs_builder')->build('my_data_lab_admin_dashboard');
        return $this->render('MyDataLabWidgetBundle::dashboard.html.twig', [
                    'widgetsPerParent' => $groups,
                    'saveOrderUrl' => $this->generateUrl('my_data_lab_widget_save_order'),
                    'title' => \ucwords($this->get('translator')->trans('TURNOVER')),
        ]);
    }

}
