<?php

namespace App\Controller\calendrierDRH;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CalendrierController extends AbstractController
{
    /**
     * @Route("u/calendrierDRH", name="app_calendrier_drh")
     */
    public function index(): Response
    {
        return $this->render('calendrierDRH/calendrierDRH.html.twig', [
            'controller_name' => 'CalendrierController',
        ]);
    }
}
