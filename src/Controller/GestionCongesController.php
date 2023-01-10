<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GestionCongesController extends AbstractController
{
    /**
     * @Route("u/gestionconges", name="app_gestionconges")
     */


    public function index(): Response
    {
        return $this->render('pages/gestionconges.html.twig', [
            'controller_name' => 'GestionCongesController',
        ]);
    }
}
