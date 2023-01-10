<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfilController extends AbstractController
{
    /**
     * @Route("u/profil", name="app_profil")
     */


    public function index(): Response
    {
        return $this->render('pages/profil.html.twig', [
            'controller_name' => 'ProfilController',
        ]);
    }
}
