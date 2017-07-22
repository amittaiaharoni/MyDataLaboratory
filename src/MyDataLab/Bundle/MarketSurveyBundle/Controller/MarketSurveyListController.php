<?php

namespace MyDataLab\Bundle\MarketSurveyBundle\Controller;

use MyDataLab\Bundle\MarketSurveyBundle\Entity\MarketSurvey;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MarketSurveyListController extends Controller
{

    public function listAction()
    {
        $this->get('my_data_lab_admin.breadcrumbs_builder')->build('my_data_lab_admin_dashboard');
        $marketSurveys = $this->getDoctrine()->getRepository(MarketSurvey::class)->findAll();

        return $this->render('MyDataLabMarketSurveyBundle:MarketSurvey:list.html.twig', [
            'marketSurveys' => $marketSurveys
        ]);
    }

    public function overviewAction($id)
    {
        $this->get('my_data_lab_admin.breadcrumbs_builder')->build('my_data_lab_admin_dashboard');
        $marketSurvey = $this->getDoctrine()->getRepository(MarketSurvey::class)->find($id);

        $dummyDataRetailers = [];
        for ($i = 0; $i < 643; $i++){
            $randRank = ['A+', 'A', 'B', 'C', 'D', 'E'];
            $test = [];
            $test['Name'] = 'E-Retailer '.$i;
            $test['Nb of prod.'] = rand(100, 20000);
            $test['Alexa rk Intl'] = rand(100, 40000);
            $test['Alexa rk ctry'] = rand(100, 20000);
            $test['Insight rk'] = rand(100, 10000);
            $test['SEMRush trf.'] = rand(100, 11000);
            $test['MDL Score'] = $randRank[rand(0, 4)];

            $dummyDataRetailers[] = $test;
        }

        $dummyDataMarketPlaces = [];
        for ($i = 0; $i < 643; $i++){
            $randRank = ['A+', 'A', 'B', 'C', 'D', 'E'];
            $test = [];
            $test['Name'] = 'MP '.$i;
            $test['Nb of resellers.'] = rand(100, 20000);
            $test['Nb of prod.'] = rand(100, 20000);
            $test['Alexa rk Intl'] = rand(100, 40000);
            $test['Alexa rk ctry'] = rand(100, 20000);
            $test['Insight rk'] = rand(100, 10000);
            $test['SEMRush trf.'] = rand(100, 11000);
            $test['MDL Score'] = $randRank[rand(0, 4)];

            $dummyDataMarketPlaces[] = $test;
        }

        $dummyDataBrands = [];
        for ($i = 0; $i < 643; $i++){
            $randRank = ['A+', 'A', 'B', 'C', 'D', 'E'];
            $test = [];
            $test['Name'] = 'Brand '.$i;
            $test['Nb of MP.'] = rand(100, 20000);
            $test['Nb of E-ret.'] = rand(100, 20000);
            $test['Nb of prod.'] = rand(100, 40000);
            $test['Min. price'] = rand(100, 20000);
            $test['Avrge price'] = rand(100, 10000);
            $test['Max. price'] = rand(100, 11000);
            $test['MDL Score'] = $randRank[rand(0, 4)];

            $dummyDataBrands[] = $test;
        }

        $dummyDataProducts = [];
        for ($i = 0; $i < 643; $i++){
            $randRank = ['A+', 'A', 'B', 'C', 'D', 'E'];
            $test = [];
            $test['Name'] = 'Prod '.$i;
            $test['Nb of MP.'] = rand(100, 20000);
            $test['Nb of E-ret.'] = rand(100, 20000);
            $test['Nb of prod.'] = rand(100, 40000);
            $test['Min. price'] = rand(100, 20000);
            $test['Avrge price'] = rand(100, 10000);
            $test['Max. price'] = rand(100, 11000);
            $test['MDL Score'] = $randRank[rand(0, 4)];

            $dummyDataProducts[] = $test;
        }

        $dummyData = [
            ['Name' => 'XXX1', 'Traffic score' => 10200, 'Nb of prod.' => 36921],
            ['Name' => 'XXX2', 'Traffic score' => 8523, 'Nb of prod.' => 20865],
            ['Name' => 'XXX3', 'Traffic score' => 7569, 'Nb of prod.' => 30125],
            ['Name' => 'XXX4', 'Traffic score' => 5231, 'Nb of prod.' => 12369],
            ['Name' => 'XXX5', 'Traffic score' => 3684, 'Nb of prod.' => 25639],
            ['Name' => 'XXX6', 'Traffic score' => 3512, 'Nb of prod.' => 15843],
            ['Name' => 'XXX7', 'Traffic score' => 2132, 'Nb of prod.' => 5632],
            ['Name' => 'XXX8', 'Traffic score' => 1269, 'Nb of prod.' => 5881],
            ['Name' => 'XXX9', 'Traffic score' => 862, 'Nb of prod.' => 2312],
            ['Name' => 'XXX10', 'Traffic score' => 521, 'Nb of prod.' => 982]
        ];

        $dummyDataSmallBrands = [
            ['Name' => 'XXX1', 'Nb of sellers' => 10200, 'Nb of prod.' => 36921],
            ['Name' => 'XXX2', 'Nb of sellers' => 8523, 'Nb of prod.' => 20865],
            ['Name' => 'XXX3', 'Nb of sellers' => 7569, 'Nb of prod.' => 30125],
            ['Name' => 'XXX4', 'Nb of sellers' => 5231, 'Nb of prod.' => 12369],
            ['Name' => 'XXX5', 'Nb of sellers' => 3684, 'Nb of prod.' => 25639],
            ['Name' => 'XXX6', 'Nb of sellers' => 3512, 'Nb of prod.' => 15843],
            ['Name' => 'XXX7', 'Nb of sellers' => 2132, 'Nb of prod.' => 5632],
            ['Name' => 'XXX8', 'Nb of sellers' => 1269, 'Nb of prod.' => 5881],
            ['Name' => 'XXX9', 'Nb of sellers' => 862, 'Nb of prod.' => 2312],
            ['Name' => 'XXX10', 'Nb of sellers' => 521, 'Nb of prod.' => 982]
        ];

        $dummyDataProducts = [
            ['name' => 'XXX1', 'Nb of sellers' => 10200, 'Average Price' => 36921],
            ['name' => 'XXX2', 'Nb of sellers' => 8523, 'Average Price' => 20865],
            ['name' => 'XXX3', 'Nb of sellers' => 7569, 'Average Price' => 30125],
            ['name' => 'XXX4', 'Nb of sellers' => 5231, 'Average Price' => 12369],
            ['name' => 'XXX5', 'Nb of sellers' => 3684, 'Average Price' => 25639],
            ['name' => 'XXX6', 'Nb of sellers' => 3512, 'Average Price' => 15843],
            ['name' => 'XXX7', 'Nb of sellers' => 2132, 'Average Price' => 5632],
            ['name' => 'XXX8', 'Nb of sellers' => 1269, 'Average Price' => 5881],
            ['name' => 'XXX9', 'Nb of sellers' => 862, 'Average Price' => 2312],
            ['name' => 'XXX10', 'Nb of sellers' => 521, 'Average Price' => 982]
        ];



        $options = [
            'marketSurvey' => $marketSurvey,
            'topRetailers' => $dummyData,
            'topBrands' => $dummyDataSmallBrands,
            'topMarketPlaces' => $dummyData,
            'topProducts' => $dummyDataSmallBrands,
            'retailers' => $dummyDataRetailers,
            'marketPlaces' => $dummyDataMarketPlaces,
            'brands' => $dummyDataBrands,
            'products' => $dummyDataProducts
        ];

        return $this->render('MyDataLabMarketSurveyBundle:MarketSurvey:overview.html.twig', $options);
    }

}
