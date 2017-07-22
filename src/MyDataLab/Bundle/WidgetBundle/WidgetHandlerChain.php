<?php

namespace MyDataLab\Bundle\WidgetBundle;

class WidgetHandlerChain
{

    private $widgetHandlers;

    public function __construct()
    {
        $this->widgetHandlers = [];
    }

    public function addWidgetHandler(WidgetHandlerInterface $widgetHandler, $name)
    {
        $this->widgetHandlers[$name] = $widgetHandler;
    }

    /**
     * 
     * @param string $name
     * @return WidgetHandlerInterface|null
     */
    public function getWidgetHandler($name)
    {
        if (isset($this->widgetHandlers[$name])) {
            return $this->widgetHandlers[$name];
        }
    }

}
