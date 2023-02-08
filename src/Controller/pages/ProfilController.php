<?php
namespace App\Controller\pages;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class ProfilController extends AbstractController
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    #[Route('/profil', name: 'app_profil')]
    public function index()
    {
        $user = $this->security->getUser();

        return $this->render('pages/profil.html.twig', [
            'controller_name' => 'ProfilController',
            'user' => $user
        ]);
    }
}