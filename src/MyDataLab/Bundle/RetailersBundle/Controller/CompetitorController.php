<?php

namespace MyDataLab\Bundle\RetailersBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CompetitorController extends Controller
{

    public function listAction()
    {
        $user = $this->getUser();
        if (!$user) {
            throw $this->createAccessDeniedException();
        }
        return $this->render('MyDataLabRetailersBundle:Competitor:list.html.twig', [
                    'competitors' => $user->getCompetitors(),
        ]);
    }

}
