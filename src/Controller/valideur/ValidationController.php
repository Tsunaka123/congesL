<?php

namespace App\Controller\valideur;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ValidationController extends AbstractController
{
    #[Route('/u/valideur_validationconges', name: 'app_valideur_validationconges')]
    public function index(): Response
    {
        return $this->render('valideur/validationDemande.html.twig', [
            'controller_name' => 'ValidationController',
        ]);
    }
}
