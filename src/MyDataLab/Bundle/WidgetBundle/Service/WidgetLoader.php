<?php

namespace MyDataLab\Bundle\WidgetBundle\Service;

use MyDataLab\Bundle\WidgetBundle\Entity\Widget;
use MyDataLab\Bundle\UserBundle\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Yaml\Yaml;
use Doctrine\Common\Collections\ArrayCollection;

class WidgetLoader
{

    const WIDGETS_FILE_PATH = '/config/widgets.yml';

    /**
     *
     * @var string
     */
    private $rootDir;

    /**
     *
     * @var array
     */
    private $widgetsConfig;

    /**
     *
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(EntityManagerInterface $em, $rootDir)
    {
        $this->rootDir = $rootDir;
        $this->em = $em;
    }

    private function loadWidgets()
    {
        if (isset($this->widgetsConfig)) {
            return;
        }
        $this->widgetsConfig = [];
        $filepath = $this->rootDir . static::WIDGETS_FILE_PATH;
        $content = $this->parseContent(\file_get_contents($filepath));
        if (!empty($content)) {
            $this->widgetsConfig = $content['widgets'];
        }
    }

    /**
     * 
     * @param User $user
     * @param array $parents
     * @return ArrayCollection
     */
    public function initWidgets(User $user, array $parents)
    {
        $widgets = new ArrayCollection();
        $positions = [];
        foreach ($this->getWidgetsConfig()as $widgetConfig) {
            $widget = new Widget();
            $parent = $widgetConfig['parent'];
            if (!in_array($parent, $parents)) {
                continue;
            }
            if (!isset($positions[$parent])) {
                $positions[$parent] = 1;
            }
            $widget
                    ->setName($widgetConfig['name'])
                    ->setParent($parent)
                    ->setUser($user)
                    ->setPosition($positions[$parent] ++)
            ;
            $widgets->add($widget);
            $this->em->persist($widget);
        }
        $this->em->flush();
        return $widgets;
    }

    public function getWidgets(User $user, array $parents)
    {
        $widgets = $this->em->getRepository('MyDataLabWidgetBundle:Widget')->findBy([
            'parent' => array_keys($parents),
            'user' => $user,
                ], [
            'parent' => 'ASC',
            'position' => 'ASC',
        ]);
        if (count($widgets)) {
            return $widgets;
        }
        return $this->initWidgets($user, array_keys($parents));
    }

    public function getWidgetGroups(User $user, array $parents)
    {
        $widgets = $this->getWidgets($user, $parents);
        /* @var $widget Widget */
        foreach ($widgets as $widget) {
            $parent = $widget->getParent();
            $parents[$parent]['widgets'][] = $widget;
        }
        return $parents;
    }

    /**
     * 
     * @return array
     */
    public function getWidgetsConfig()
    {
        $this->loadWidgets();

        return $this->widgetsConfig;
    }

    private function parseContent($file)
    {
        return Yaml::parse($file);
    }

}
