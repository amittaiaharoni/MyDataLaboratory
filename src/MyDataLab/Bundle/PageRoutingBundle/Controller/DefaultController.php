<?php

namespace MyDataLab\Bundle\PageRoutingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use MyDataLab\Bundle\PageRoutingBundle\Form\PageRoutingType;
use MyDataLab\Bundle\PageRoutingBundle\Entity\PageRouting;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Routing\Route;
use Symfony\Component\Filesystem\Filesystem;

class DefaultController extends Controller
{

    public function indexAction(Request $request)
    {
        $routes = $this->getDoctrine()->getRepository('MyDataLabPageRoutingBundle:PageRouting')->findByLocale($request->getLocale());
        return $this->render('MyDataLabPageRoutingBundle:Default:index.html.twig', [
                    'routes' => $routes,
        ]);
    }

    public function editAction(Request $request, $id)
    {
        $route = $this->getDoctrine()->getRepository('MyDataLabPageRoutingBundle:PageRouting')->find($id);
        if (!$route) {
            throw $this->createNotFoundException('Route with id ' . $id . ' not found');
        }
        $editForm = $this->createForm(PageRoutingType::class, $route);
        $editForm->add('Save', SubmitType::class);
        $editForm->handleRequest($request);
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($route);
            $em->flush();
            return $this->warmUpRouteCache()->redirectToRoute('my_data_lab_page_routing_edit', [
                        'id' => $route->getId(),
            ]);
        }
        return $this->render('MyDataLabPageRoutingBundle:Default:edit.html.twig', [
                    'editForm' => $editForm->createView(),
        ]);
    }

    /**
     * 
     * @param string $name
     * @return Route|null
     */
    private function getRouteByName($name)
    {
        $routes = $this->get('router')->getRouteCollection();
        /* @var $route Symfony\Component\Routing\Route */
        foreach ($routes as $routeName => $route) {
            if ($routeName == $name) {
                return $route;
            }
        }
        return null;
    }

    public function createAction(Request $request)
    {
        $pageRouting = new PageRouting();
        $form = $this->createForm(PageRoutingType::class, $pageRouting);
        $form->add('save', SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $doctrine = $this->getDoctrine();
            $language = $doctrine->getRepository('MyDataLabCoreBundle:Language')->findOneBy([
                'code' => $request->getLocale(),
            ]);
            $pageRouting->setLanguage($language);
            $route = $this->getRouteByName($pageRouting->getName());
            if ($route) {
                $pageRouting->setController($route->getDefault('_controller'));
            }
            $em = $doctrine->getManager();
            $em->persist($pageRouting);
            $em->flush($pageRouting);

//            //cache clear
//            $fs = new Filesystem();
//            $fs->remove($this->container->getParameter('kernel.cache_dir'));
            return $this->warmUpRouteCache()->redirectToRoute('my_data_lab_page_routing_edit', [
                        'id' => $pageRouting->getId(),
            ]);
        }
        return $this->render('MyDataLabPageRoutingBundle:Default:create.html.twig', [
                    'createForm' => $form->createView(),
        ]);
    }

    //http://stackoverflow.com/questions/16494232/how-clear-routing-cache-in-symfony-2
    private function warmUpRouteCache()
    {
        $router = $this->get('router');
        $filesystem = $this->get('filesystem');
        $kernel = $this->get('kernel');
        $cacheDir = $kernel->getCacheDir();

        foreach (['matcher_cache_class', 'generator_cache_class'] as $option) {
            $className = $router->getOption($option);
            $cacheFile = $cacheDir . DIRECTORY_SEPARATOR . $className . '.php';
            $filesystem->remove($cacheFile);
        }

        $router->warmUp($cacheDir);
        return $this;
    }

}
