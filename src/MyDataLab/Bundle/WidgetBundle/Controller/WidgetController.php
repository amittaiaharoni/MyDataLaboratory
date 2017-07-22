<?php

namespace MyDataLab\Bundle\WidgetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class WidgetController extends Controller
{

    public function saveOrderAction(Request $request)
    {
        $user = $this->getUser();
        if (!$user) {
            return new JsonResponse([
                'success' => false,
            ]);
        }
        $manager = $this->getDoctrine()->getManager();
        $data = $request->get('widgets');
        $parent = $request->get('parent');
        $ids = \array_keys($data);
        $widgets = $manager->getRepository('MyDataLabWidgetBundle:Widget')->findBy([
            'id' => $ids,
        ]);
        /* @var $widget MyDataLab\Bundle\WidgetBundle\Entity\Widget */
        foreach ($widgets as $widget) {
            $widget
                    ->setParent($parent)
                    ->setPosition((int) $data[$widget->getId()])
            ;
            $manager->persist($widget);
        }
        $manager->flush();
        return new JsonResponse([
            'status' => true,
        ]);
    }

    public function resetOrderAction(Request $request)
    {
        $ids = $request->get('ids');
        $manager = $this->getDoctrine()->getManager();
        $widgets = $manager->getRepository('MyDataLabWidgetBundle:Widget')->findBy([
            'id' => $ids,
        ]);
        foreach ($widgets as $widget) {
            $manager->remove($widget);
        }
        $manager->flush();
        return new JsonResponse([
            'ids' => $ids,
        ]);
    }

}
