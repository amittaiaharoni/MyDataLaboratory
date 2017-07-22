<?php

namespace MyDataLab\Bundle\CrawlerBundle\Controller;

use MyDataLab\Bundle\CrawlerBundle\Entity\SettingItem;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class CrawlerController extends Controller
{

    private $settings = [
        [
            'selectorId' => 'siteTitle',
            'image' => false,
            'xpath' => '',
            'value' => '',
        ], [
            'selectorId' => 'siteDescription',
            'image' => false,
            'xpath' => '',
            'value' => '',
        ], [
            'selectorId' => 'siteBrand',
            'image' => false,
            'xpath' => '',
            'value' => '',
        ], [
            'selectorId' => 'siteCategories',
            'image' => false,
            'xpath' => '',
            'value' => '',
        ], [
            'selectorId' => 'siteEAN13',
            'image' => false,
            'xpath' => '',
            'value' => '',
        ], [
            'selectorId' => 'siteReference',
            'image' => false,
            'xpath' => '',
            'value' => '',
        ], [
            'selectorId' => 'siteImage',
            'image' => true,
            'xpath' => '',
            'value' => '',
        ], [
            'selectorId' => 'sitePrice',
            'image' => false,
            'xpath' => '',
            'value' => '',
        ], [
            'selectorId' => 'sitePriceOld',
            'image' => false,
            'xpath' => '',
            'value' => '',
        ], [
            'selectorId' => 'siteTypePromo',
            'image' => false,
            'xpath' => '',
            'value' => '',
        ], [
            'selectorId' => 'sitePriceTTCHT',
            'image' => false,
            'xpath' => '',
            'value' => '',
        ], [
            'selectorId' => 'siteCurrency',
            'image' => false,
            'xpath' => '',
            'value' => '',
        ], [
            'selectorId' => 'siteShipmentPrice',
            'image' => false,
            'xpath' => '',
            'value' => '',
        ], [
            'selectorId' => 'siteState',
            'image' => false,
            'xpath' => '',
            'value' => '',
        ], [
            'selectorId' => 'siteProductMark',
            'image' => false,
            'xpath' => '',
            'value' => '',
        ], [
            'selectorId' => 'siteBreadcrumb',
            'image' => false,
            'xpath' => '',
            'value' => '',
        ],
    ];

    /**
     * Lists all item entities.
     *
     */
    public function configAction($retailerId)
    {
        $user = $this->getUser();
        if (!$user) {
            //@TODO FIX THIS THROUGH security.yml!!!
            throw $this->createAccessDeniedException();
        }
        $em = $this->getDoctrine()->getManager();
        $retailer = $em->getRepository('MyDataLabRetailersBundle:Retailer')->find($retailerId);

        $settings = $em->getRepository('MyDataLabCrawlerBundle:SettingItem')->findBy([
            'retailer' => $retailer,
        ]);

        return $this->render('MyDataLabCrawlerBundle:Crawler:config.html.twig', [
                    'settings' => count($settings) ? $settings : $this->settings,
                    'retailer' => $retailer,
                    'donwloadedPageUrl' => $this->get('my_data_lab_crawler.crawler')->getDownloadedFileURL($retailer),
        ]);
    }

    public function saveConfigAction(Request $request)
    {
        $doctrine = $this->getDoctrine();
        $retailer = $doctrine->getRepository('MyDataLabRetailersBundle:Retailer')->find((int) $request->get('retailerId'));
        if (!$retailer) {
            return new JsonResponse([
                'success' => false,
                    ], JsonResponse::HTTP_NOT_FOUND);
        }
        $settings = $request->get('settings');
        $existingSettings = $doctrine->getRepository('MyDataLabCrawlerBundle:SettingItem')->findBy([
            'retailer' => $retailer,
        ]);
        $em = $doctrine->getManager();
        if (count($existingSettings)) {
            /* @var $existingSetting SettingItem */
            foreach ($existingSettings as $existingSetting) {
                foreach ($settings as $setting) {
                    if ($setting['selectorId'] == $existingSetting->getSelectorId()) {
                        $existingSetting->setXpath($setting['xpath']);
                        continue;
                    }
                }
                $em->persist($existingSetting);
            }
        } else {
            foreach ($settings as $setting) {
                $settingObject = new SettingItem();
                $settingObject
                        ->setSelectorId($setting['selectorId'])
                        ->setXpath($setting['xpath'])
                        ->setRetailer($retailer)
                ;
                $em->persist($settingObject);
            }
        }
        $em->flush();
        return new JsonResponse([
            'success' => true,
            'retailerId' => $retailer,
        ]);
    }

}
