<?php

namespace MyDataLab\Bundle\MarketSurveyBundle\Controller;

use MyDataLab\Bundle\MarketSurveyBundle\Entity\MarketSurvey;
use MyDataLab\Bundle\MarketSurveyBundle\Entity\MarketSurveyActivity;
use MyDataLab\Bundle\MarketSurveyBundle\Entity\MarketSurveyBrand;
use MyDataLab\Bundle\MarketSurveyBundle\Entity\MarketSurveyCategory;
use MyDataLab\Bundle\MarketSurveyBundle\Entity\MarketSurveyMarketPlace;
use MyDataLab\Bundle\RetailersBundle\Entity\Retailer;
use MyDataLab\Bundle\MarketSurveyBundle\Form\MarketSurveyType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;

class MarketSurveyController extends Controller
{

    public function designAction()
    {
        $marketSurveyForm = $this->createForm(MarketSurveyType::class, new MarketSurvey(), [
            'method' => 'POST',
            'action' => $this->generateUrl('my_data_lab_market_survey_create')
        ]);

        return $this->render('MyDataLabMarketSurveyBundle:MarketSurvey:design.html.twig', [
            'form' => $marketSurveyForm->createView()
        ]);
    }

    public function createAction(Request $request)
    {
        $manager = $this->getDoctrine();
        $formData = $request->request->get('surveyData');

        $marketSurvey = new  MarketSurvey();
        $marketSurvey->setName($formData['name']);
        $marketSurvey->setRetailers($manager->getRepository(Retailer::class)->findBy(['name' => $formData['retailers']]));
        $marketSurvey->setActivity($manager->getRepository(MarketSurveyActivity::class)->findBy(['name' => $formData['activities']]));
        $marketSurvey->setBrands($manager->getRepository(MarketSurveyBrand::class)->findBy(['name' => $formData['brands']]));
        $marketSurvey->setMarketPlaces($manager->getRepository(MarketSurveyMarketPlace::class)->findBy(['name' => $formData['marketPlaces']]));

        $marketSurvey->setTimeSlotStart(new \DateTime($formData['timeSlotStart']));
        $marketSurvey->setTimeSlotEnd(new \DateTime($formData['timeSlotEnd']));

        $mainCategories = $manager->getRepository(MarketSurveyCategory::class)->findBy(['name' => $formData['mainCategories'], 'parentCategory' => null]);
        $marketSurvey->setMainCategories($mainCategories);

        $categories = $manager->getRepository(MarketSurveyCategory::class)->findBy(['name' => $formData['categories'], 'parentCategory' => $mainCategories]);
        $marketSurvey->setCategories($categories);

        $subCategories = $manager->getRepository(MarketSurveyCategory::class)->findBy(['name' => $formData['subCategories'], 'parentCategory' => $categories]);
        $marketSurvey->setSubCategories($subCategories);

        $manager = $manager->getManager();
        $manager->persist($marketSurvey);
        $manager->flush();


        $serializer = new Serializer(array(new GetSetMethodNormalizer()), array('json' => new
        JsonEncoder()));
        $json = $serializer->serialize($marketSurvey, 'json');
        return new Response($this->generateUrl('my_data_lab_market_survey_list_index'));
    }

    public function overviewAction()
    {
        
        // $this->get('my_data_lab_admin.breadcrumbs_builder')->build('my_data_lab_admin_dashboard');
        return $this->render('MyDataLabMarketSurveyBundle:MarketSurvey:overview.html.twig');
    }

    public function getAction($attribute, Request $request)
    {
        $manager = $this->getDoctrine();

        if($this->isCategoryAttribute($attribute)){
            $attributesArray = $this->generateCategoryArray($attribute, $request->get('extraData'));
        }
        else if($attribute === 'brand'){
            $attributesArray = $manager->getRepository('MyDataLabProductBundle:Brand')->findAll();
        }
        else if($attribute === 'retailer'){
            $attributesArray = $manager->getRepository('MyDataLabRetailersBundle:Retailer')->findAll();
        }
        else{
            $attributesArray = $manager->getRepository($this->generateRepositoryLink($attribute))->findAll();
        }

        return new JsonResponse($this->generateSelect2Array($attributesArray));
    }

    /**
     * @param array $doctrineCollection
     * @return array
     */
    private function generateSelect2Array($doctrineCollection)
    {
        $select2Array = [];
        foreach ($doctrineCollection as $key => $value){
            $select2Array[$key]['id'] = $key + 1;
            $select2Array[$key]['name'] = $doctrineCollection[$key]->getName();
        }

        return $select2Array;
    }

    /**
     * @param string $attribute
     * @return boolean
     */
    private function isCategoryAttribute($attribute)
    {
        if($attribute === 'mainCategory' || $attribute === 'category' || $attribute === 'subCategory'){
            return true;
        }
        return false;
    }

    /**
     * @param string $attribute
     * @param array|null $extraData
     * @return array|MarketSurveyCategory[]
     */
    private function generateCategoryArray($attribute, $extraData = null)
    {
        $manager = $this->getDoctrine();

        if($attribute === 'mainCategory'){
            $attributesArray = $manager->getRepository(MarketSurveyCategory::class)->findBy(['parentCategory' => null]);
        }
        else if($attribute === 'category' || $attribute === 'subCategory'){
            $parentsArray = $manager->getRepository(MarketSurveyCategory::class)->findBy(['name' => $extraData]);
            $attributesArray = $manager->getRepository(MarketSurveyCategory::class)->findBy(['parentCategory' => $parentsArray]);
        }

        return $attributesArray;
    }

    private function generateRepositoryLink($type)
    {
        switch ($type){
            case 'activity':
                return 'MyDataLabMarketSurveyBundle:MarketSurveyActivity';
            case 'retailer':
                return 'MyDataLabRetailersBundle:Retailer';
            case 'marketPlace':
                return 'MyDataLabMarketSurveyBundle:MarketSurveyMarketPlace';
            case 'brand':
                return 'MyDataLabMarketSurveyBundle:MarketSurveyBrand';
        };
        return null;
    }

}
