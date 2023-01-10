<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainPageController extends AbstractController
{
    /**
     * @Route("/u/acceuil", name="homepage")
     */
    public function index(): Response
    {
        return $this->render('pages/mainpage.html.twig', [
            'controller_name' => 'MainPageController',
        ]);
    }
}
