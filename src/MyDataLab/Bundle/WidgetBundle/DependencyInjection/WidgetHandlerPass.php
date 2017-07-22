<?php

namespace MyDataLab\Bundle\WidgetBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

class WidgetHandlerPass implements CompilerPassInterface
{

    public function process(ContainerBuilder $container)
    {
        if (!$container->has('my_data_lab_widget.widget_handler_chain')) {
            return;
        }

        $definition = $container->findDefinition('my_data_lab_widget.widget_handler_chain');

        $taggedServices = $container->findTaggedServiceIds('mdl.widget_handler');

        foreach ($taggedServices as $id => $tags) {
            foreach ($tags as $attributes) {
                $definition->addMethodCall('addWidgetHandler', [
                    new Reference($id),
                    $attributes['alias'],
                ]);
            }
        }
    }

}
