<?php

namespace MyDataLab\Bundle\PageRoutingBundle\Routing;

use Symfony\Component\Config\Loader\Loader;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use MyDataLab\Bundle\PageRoutingBundle\Entity\PageRouting;

class MDLLoader extends Loader
{

    //inject the router to get the defaults and the parameters of the existing
    //routes, so we don't need to persist them along with the name->path pair
    //inject the object manager to get the defined routes
    private $loaded = false;

    /**
     *
     * @var EntityManagerInterface
     */
    private $entityManager;
    private $requestStack;

    public function __construct(EntityManagerInterface $entityManager, RequestStack $requestStack)
    {
        $this->entityManager = $entityManager;
        $this->requestStack = $requestStack;
    }

    /**
     * 
     * @return \Symfony\Component\HttpFoundation\Request
     */
    private function getCurrentRequest()
    {
        return $this->requestStack->getCurrentRequest();
    }

    public function load($resource, $type = null)
    {
        if ($this->loaded) {
            throw new \RuntimeException('Do not add the "mdl" loader twice');
        }
        $routes = new RouteCollection();

        $pageRoutes = $this->entityManager->getRepository('MyDataLabPageRoutingBundle:PageRouting')->findAll(); //findByLocale($this->getCurrentRequest()->getLocale());
        /* @var PageRouting $pageRoute */
        foreach ($pageRoutes as $pageRoute) {
            $defaults = [
                '_controller' => $pageRoute->getController(),
            ];
            $requirements = [
                '_locale' => $pageRoute->getLanguage()->getCode(),
            ];
            $route = new Route('/' . ltrim($pageRoute->getPath(), '/'), $defaults, $requirements);
            $routes->add($pageRoute->getName(), $route);
        }
        $this->loaded = true;
        return $routes;
    }

    public function supports($resource, $type = null)
    {
        return $type === 'mdl';
    }

}
