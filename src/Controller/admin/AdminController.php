<?php

namespace App\Controller\admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin", name="app_admin")
 */

class AdminController extends AbstractController
{

    /**
     * @Route("/dashboard", name="app_dashboard")
     */

    public function index(): Response
    {
        return $this->render('/admin/panneauadmin.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
}
