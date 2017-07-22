<?php

namespace MyDataLab\Bundle\FrontendBundle\Controller;

use MyDataLab\Bundle\GlossaryBundle\Entity\Definition;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class GlossaryController extends Controller
{

    public function indexAction($page = 1, $letter = null, $glossary = null, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $parameters = array();
        $parameters['page']['page_amount'] = $this->getParameter('items_per_page');
        $parameters['page']['page_num'] = $page;
        $parameters['locale'] = $request->getLocale();
        $parameters['letter'] = $letter;
        $parameters['glossary'] = $glossary;

        $title = $this->get('translator')->trans('PRICE_COMPETITIVE_INTELLIGENCE_GLOSSARY');
        if($glossary !== null){
            $title = $glossary.': ';
        }
        if($letter !== null){
            $title .= 'Find results for letter '.$letter;
        }

        $definitions = $em->getRepository('MyDataLabGlossaryBundle:Definition')->findAllDefinitionsByParameters($parameters);
        $glossaries = $em->getRepository('MyDataLabGlossaryBundle:Glossary')->findAll();

        $definitionsAmount = $em->getRepository('MyDataLabGlossaryBundle:Definition')->countDefinitionsByParameters($parameters);
        $pagesNum = (int)ceil($definitionsAmount/$parameters['page']['page_amount']);

        return $this->render('MyDataLabFrontendBundle:Glossary:index.html.twig', [
            'title' => $title,
            'definitions' => $definitions,
            'glossaries' => $glossaries,
            'pagesNum' => $pagesNum,
            'page' => $page,
            'letter' => $letter,
            'glossary' => $glossary
        ]);
    }

    public function definitionAction($glossary, $slug)
    {
        $glossaryEntity = $this->getDoctrine()->getManager()->getRepository('MyDataLabGlossaryBundle:Glossary')->findOneBy(array('name' => $glossary));
        if(!$glossary){
            throw $this->createNotFoundException('Glossary ' . $glossary . ' not found');
        }
        $definition = $this->getDoctrine()->getManager()->getRepository('MyDataLabGlossaryBundle:Definition')->findOneBy(array('glossary' => $glossaryEntity, 'slug' => $slug));
        if(!$glossary){
            throw $this->createNotFoundException('Definition ' . $slug . ' not found');
        }
        return $this->render('@MyDataLabFrontend/Glossary/show.html.twig', [
            'definition' => $definition
        ]);
    }

    public function paginatorAction($currentRoute, $currentParams)
    {
        $page = null;
        if(isset($currentParams['page'])){
            $page = (int)$currentParams['page'];
        }
        else{
            $page = 1;
            $currentParams['page'] = '1';
        }

        switch ($currentRoute){
            case 'my_data_lab_frontend_glossary':
                $currentRoute = 'my_data_lab_frontend_glossary_page';
                break;
            case 'my_data_lab_frontend_glossary_letter':
                $currentRoute = 'my_data_lab_frontend_glossary_letter_page';
                break;
            case 'my_data_lab_frontend_glossary_definitions':
                $currentRoute = 'my_data_lab_frontend_glossary_definitions_page';
                break;
            case 'my_data_lab_frontend_glossary_definitions_letter':
                $currentRoute = 'my_data_lab_frontend_glossary_definitions_letter_page';
                break;
        }

        $em = $this->getDoctrine()->getManager();

        $parameters = [
            'page' => [
                'page_amount' => 40,
                'page_num' => $page
            ]
        ];
        $definitionsAmount = $em->getRepository('MyDataLabGlossaryBundle:Definition')->countDefinitionsByParameters($parameters);
        $pagesNum = (int)ceil($definitionsAmount/$parameters['page']['page_amount']);

        $paginatorStart = [];
        $paginatorMiddle = [];
        $paginatorEnd = [];

        if($page > 1){
            $paginatorMiddle[] = $page - 1;
        }
        $paginatorMiddle[] = $page;
        if($page < $pagesNum){
            $paginatorMiddle[] = $page + 1;
        }

        if($page <= 4){
            for($i = 1; $i < $paginatorMiddle[0]; $i++){
                $paginatorStart[] = $i;
            }
        }
        else{
            $paginatorStart[0] = 1;
            $paginatorStart[1] = 2;
            $paginatorStart[2] = '..';
        }

        if($page >= ($pagesNum - 3)){
            for($i = (end($paginatorMiddle) + 1); $i <= $pagesNum; $i++){
                $paginatorEnd[] = $i;
            }
        }
        else{
            $paginatorEnd[0] = '..';
            $paginatorEnd[1] = $pagesNum - 1;
            $paginatorEnd[2] = $pagesNum;
        }

        $paginator = array_merge($paginatorStart, $paginatorMiddle, $paginatorEnd);

        return $this->render('@MyDataLabFrontend/Glossary/paginator.html.twig', array(
            'paginator' => $paginator,
            'currentRoute' => $currentRoute,
            'currentParams' => $currentParams
        ));
    }

    public function lettersPaginatorAction($currentRoute, $currentParams)
    {
        $letter = null;
        if(isset($currentParams['letter'])){
            $letter = $currentParams['letter'];
        }
        else{
            $letter = 'a';
            $currentParams['letter'] = null;
        }
        $currentParams['page'] = '1';

        switch ($currentRoute){
            case 'my_data_lab_frontend_glossary':
                $currentRoute = 'my_data_lab_frontend_glossary_letter';
                break;
            case 'my_data_lab_frontend_glossary_page':
                $currentRoute = 'my_data_lab_frontend_glossary_letter_page';
                break;
            case 'my_data_lab_frontend_glossary_definitions':
                $currentRoute = 'my_data_lab_frontend_glossary_definitions_letter';
                break;
            case 'my_data_lab_frontend_glossary_definitions_page':
                $currentRoute = 'my_data_lab_frontend_glossary_definitions_letter_page';
                break;
        }

        $paginator = [];
        foreach (range('a', 'z') as $alphabet){
            $paginator[] = $alphabet;
        }

        return $this->render('@MyDataLabFrontend/Glossary/letters_paginator.twig', array(
            'paginator' => $paginator,
            'currentRoute' => $currentRoute,
            'currentParams' => $currentParams
        ));
    }
}
