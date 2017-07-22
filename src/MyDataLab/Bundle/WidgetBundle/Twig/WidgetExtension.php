<?php

namespace MyDataLab\Bundle\WidgetBundle\Twig;

use Symfony\Component\DependencyInjection\ContainerInterface;
use MyDataLab\Bundle\WidgetBundle\Entity\Widget;

class WidgetExtension extends \Twig_Extension
{

    const VIEWS_LOCATION = 'MyDataLabWidgetBundle:Widget:';

    /**
     *
     * @var ContainerInterface
     */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * 
     * @return \Symfony\Bundle\FrameworkBundle\Templating\EngineInterface
     */
    private function getTemplating()
    {
        return $this->container->get('templating');
    }

    /**
     * 
     * @return \MyDataLab\Bundle\WidgetBundle\WidgetHandlerChain
     */
    private function getWidgetHandlerChain()
    {
        return $this->container->get('my_data_lab_widget.widget_handler_chain');
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('mdl_widget', [$this, 'widget'], [
                'is_safe' => ['html',],
                    ]),
        ];
    }

    /**
     * 
     * @param type $name
     * @param type $parameters
     * @return type
     * @throws \Exception
     * @obsolete
     */
    private function renderByName($name, $parameters = [])
    {
        throw new \Exception('renderByName is obsolete');
//        return $this->getTemplating()->render(self::VIEWS_LOCATION . $name . '.html.twig', $parameters);
    }

    private function renderByWidget(Widget $widget)
    {
        $name = $widget->getName();
        $handler = $this->getWidgetHandlerChain()->getWidgetHandler($name);
        $data = [
            'widget' => $widget,
        ];
        if ($handler) {
            $data = $handler->handle($widget);
        }
        return $this->getTemplating()->render(self::VIEWS_LOCATION . $name . '.html.twig', $data);
    }

//    private function
    public function widget($widget, $parameters = [])
    {
        if ($widget instanceof Widget) {
            return $this->renderByWidget($widget);
        }
        if (is_string($widget)) {
            return $this->renderByName($widget, $parameters);
        }
        throw new InvalidArgumentException('');
    }

    public function getName()
    {
        return 'mdl_widget';
    }

}
