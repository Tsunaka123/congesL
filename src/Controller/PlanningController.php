<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PlanningController extends AbstractController
{
    /**
     * @Route("u/planning", name="app_planning")
     */


    public function index(): Response
    {
        return $this->render('pages/planning.html.twig', [
            'controller_name' => 'PlanningController',
        ]);
    }
}
