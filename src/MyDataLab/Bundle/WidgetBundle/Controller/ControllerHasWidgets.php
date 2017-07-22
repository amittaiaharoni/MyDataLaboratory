<?php

namespace MyDataLab\Bundle\WidgetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

abstract class ControllerHasWidgets extends Controller
{

    public abstract function getWidgetParents();

    /**
     * 
     * @return \MyDataLab\Bundle\WidgetBundle\Service\WidgetLoader
     */
    protected function getWidgetsLoader()
    {
        return $this->get('my_data_lab_widget.widget_loader');
    }

    protected function getWidgetGroups()
    {
        $user = $this->getUser();
        return $this->getWidgetsLoader()->getWidgetGroups($user, $this->getWidgetParents());
    }

    protected function doAction(array $data = [])
    {
        $groups = $this->getWidgetGroups();
        return $this->render('MyDataLabWidgetBundle::dashboard.html.twig', \array_merge($data, [
                    'widgetsPerParent' => $groups,
                    'saveOrderUrl' => $this->generateUrl('my_data_lab_widget_save_order'),
        ]));
    }

}
