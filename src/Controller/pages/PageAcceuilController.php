<?php

namespace App\Controller\pages;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageAcceuilController extends AbstractController
{
    /**
     * @Route("/u/acceuil", name="app_pageacceuil")
     */
    public function index(): Response
    {
        return $this->render('pages/pageacceuil.html.twig', [
            'controller_name' => 'PageAcceuilController',
        ]);
    }
}
