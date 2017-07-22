<?php

namespace MyDataLab\Bundle\WidgetBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use MyDataLab\Bundle\WidgetBundle\DependencyInjection\WidgetHandlerPass;

class MyDataLabWidgetBundle extends Bundle
{

    public function build(\Symfony\Component\DependencyInjection\ContainerBuilder $container)
    {
        $container->addCompilerPass(new WidgetHandlerPass());
    }

}
