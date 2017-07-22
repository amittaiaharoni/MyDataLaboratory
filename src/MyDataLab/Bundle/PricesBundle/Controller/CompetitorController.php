<?php

namespace MyDataLab\Bundle\PricesBundle\Controller;

use MyDataLab\Bundle\WidgetBundle\Controller\ControllerHasWidgets;

class CompetitorController extends ControllerHasWidgets
{

    private $parents = [
        'sortable24' => [
            'widgets' => [],
            'class' => 'connectedSortable col-lg-4',
        ],
        'sortable25' => [
            'widgets' => [],
            'class' => 'connectedSortable col-lg-8',
        ],
        'sortable26' => [
            'widgets' => [],
            'class' => 'connectedSortable col-lg-4',
        ],
        'sortable27' => [
            'widgets' => [],
            'class' => 'connectedSortable col-lg-4',
        ],
        'sortable28' => [
            'widgets' => [],
            'class' => 'connectedSortable col-lg-4',
        ],
        'sortable29' => [
            'widgets' => [],
            'class' => 'connectedSortable col-lg-12',
        ],
    ];

    public function getWidgetParents()
    {
        return $this->parents;
    }

    public function listAction()
    {
        $user = $this->getUser();
        if (!$user) {
            //@TODO FIX THIS THROUGH security.yml
            throw $this->createAccessDeniedException();
        }
        $this->get('my_data_lab_admin.breadcrumbs_builder')->build('my_data_lab_prices_competitors_list');
        return $this->doAction([
                    'title' => 'Competitors / E-Retailers',
        ]);
//        return $this->render('MyDataLabPricesBundle:Competitor:list.html.twig');
    }

}
