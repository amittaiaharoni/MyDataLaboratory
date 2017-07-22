<?php

namespace MyDataLab\Bundle\WidgetBundle;

use MyDataLab\Bundle\WidgetBundle\Entity\Widget;

interface WidgetHandlerInterface
{

    /**
     * 
     * @param Widget $widget
     * @return array to pass to the view
     */
    public function handle(Widget $widget);
    
    /**
     * @return string
     */
    public function getName();
}
