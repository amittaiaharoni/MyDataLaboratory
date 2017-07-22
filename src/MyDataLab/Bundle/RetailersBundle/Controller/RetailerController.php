<?php

namespace MyDataLab\Bundle\RetailersBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use MyDataLab\Bundle\RetailersBundle\Entity\Retailer;

class RetailerController extends Controller
{

    public function addAction(Request $request)
    {
        /* @var $user \MyDataLab\Bundle\UserBundle\Entity\User */
        $user = $this->getUser();
        if (!$user) {
            throw $this->createAccessDeniedException();
        }
        $retailer = new Retailer();
        $retailer->setProductPage($request->get('retailer'));
        $user->getCompetitors()->add($retailer);
        $manager = $this->getDoctrine()->getManager();
        $manager->persist($retailer);
        $manager->persist($user);
        $manager->flush();
        /* @var $crawler \MyDataLab\Bundle\CrawlerBundle\Crawler */
        $crawler = $this->get('my_data_lab_crawler.crawler');
        $response = array_merge($crawler->downloadPageByRetailer($retailer), [
            'success' => true,
        ]);
        return new JsonResponse($response);
    }

    public function deleteAction($id)
    {
        /* @var $user \MyDataLab\Bundle\UserBundle\Entity\User */
        $user = $this->getUser();
        if (!$user) {
            return new JsonResponse([
                'success' => false,
            ]);
        }
        $em = $this->getDoctrine()->getManager();
        $retailer = $em->getRepository('MyDataLabRetailersBundle:Retailer')->find($id);
        if (!$retailer) {
            return new JsonResponse([
                'success' => false,
            ]);
        }
        if (!$user->getCompetitors()->contains($retailer)) {
            return new JsonResponse([
                'success' => false,
            ]);
        }
        $user->removeCompetitor($retailer);
        $em->persist($user);
        $em->flush();
        return new JsonResponse([
            'success' => true,
        ]);
    }

}
