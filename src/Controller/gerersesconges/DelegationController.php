<?php

namespace App\Controller\gerersesconges;

use App\Controller\gerersesconges\GererSesCongesController;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/u/gerersesconges")
 */

class DelegationController extends AbstractController
{
    /**
     * @Route("/delegation", name="app_gerersesconges_delegation", methods={"GET"})
     */
    public function delegation(UserRepository $userRepository): Response
    {
        return $this->render('gerersesconges/delegation.html.twig', [
            'user' => $userRepository->findAll()
                ]

        );
    }
}