<?php

namespace App\Controller\security;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProtectionUserConnectedController extends AbstractController
{
    /**
     * @Route("u", name="app_user_connected")
     */

    public function index(): Response
    {
        return $this->render('pageacceuil.html.twig', [
            'controller_name' => 'ProtectionUserConnectedController',
        ]);
    }
}
