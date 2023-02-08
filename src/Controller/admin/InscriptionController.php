<?php

namespace App\Controller\admin;

use App\Entity\Service;
use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Repository\ServiceRepository;
use App\Security\UserAuthentificator;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Monolog\Handler\Curl\Util;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;

class InscriptionController extends AbstractController
{
    /**
     * @Route("admin/inscription", name="app_register")
     */

    //todo: Faire un message succes creation de compte


    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, UserAuthenticatorInterface $userAuthenticator, UserAuthentificator $authenticator, EntityManagerInterface $entityManager): Response
    {
        $utilisateur = new User();
        $form = $this->createForm(RegistrationFormType::class, $utilisateur);
        $form->handleRequest($request);

        dump($utilisateur);
        if ($form->isSubmitted() && $form->isValid()) {


            $data = $form->get('idServiceFromForm')->getData();
            dump($data);

            foreach ($data as $item) {
                $idf[] = $item->getId();
            }
            dump($idf);

            $utilisateur->setIdServiceU([$idf]);
            dump($utilisateur);
            // encode the plain password
            $utilisateur->setPassword(
                $userPasswordHasher->hashPassword(
                    $utilisateur,
                    $form->get('plainPassword')->getData()
                )
            );
            dump($utilisateur);
            $entityManager->persist($utilisateur);
            $entityManager->flush();
+
            $this->addFlash(
                'notice',
                'Le compte a été créé avec succès.');


            return $this->redirectToRoute('app_register');

        }

        return $this->render('admin/inscription.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }


}


