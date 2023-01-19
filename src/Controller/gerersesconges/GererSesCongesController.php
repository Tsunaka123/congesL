<?php

namespace App\Controller\gerersesconges;

use App\Entity\Conges;
use App\Form\NouveauCongesFormType;
use App\Repository\GererSesCongesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/u/gerersesconges")
 */
class GererSesCongesController extends AbstractController
{
    /**
     * @Route("/voirsesconges", name="app_gerersesconges_voirsesconges", methods={"GET"})
     */
    public function index(GererSesCongesRepository $gerersescongesRepository): Response
    {
        return $this->render('gerersesconges/voirsesconges.html.twig', [
            'conges' => $gerersescongesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/", name="app_gerersesconges_nouveauconges", methods={"GET","POST"})
     */
    public function new(Request $request,EntityManagerInterface $entityManager): Response
    {
        $conges = new Conges();
        $form = $this->createForm(NouveauCongesFormType::class, $conges);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($conges);
            $entityManager->flush();

            return $this->redirectToRoute('app_gerersesconges_voirsesconges');
        }

        return $this->render('gerersesconges/nouveauconges.html.twig', [
            'conges' => $conges,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_gerersesconges_detailsconges", methods={"GET"})
     */
    public function show(Conges $conges): Response
    {
        return $this->render('gerersesconges/detailsconges.html.twig', [
            'conges' => $conges,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_gerersesconges_modifierconges", methods={"GET","POST"})
     */
    public function edit(Request $request, Conges $conges, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(NouveauCongesFormType::class, $conges);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($conges);
            $entityManager->flush();

            return $this->redirectToRoute('app_gerersesconges_voirsesconges');
        }

        return $this->render('gerersesconges/modifierconges.html.twig', [
            'conges' => $conges,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_gerersesconges_supprimerconges", methods={"DELETE"})
     */
    public function delete(Request $request, Conges $conges): Response
    {
        if ($this->isCsrfTokenValid('delete'.$conges->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($conges);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_gerersesconges_voirsesconges');
    }
}