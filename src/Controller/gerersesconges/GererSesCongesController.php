<?php

namespace App\Controller\gerersesconges;

use App\Entity\CongesDemande;
use App\Form\NouveauCongesFormType;
use App\Repository\CongesDemandeRepository;
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
    public function index(CongesDemandeRepository $congesDemandeRepository): Response
    {
        return $this->render('gerersesconges/voirsesconges.html.twig', [
            'congesdemande' => $congesDemandeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/", name="app_gerersesconges_nouveauconges", methods={"GET","POST"})
     */
    public function new(Request $request,EntityManagerInterface $entityManager): Response
    {
        $congesdemande = new CongesDemande();
        $form = $this->createForm(NouveauCongesFormType::class, $congesdemande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($congesdemande);
            $entityManager->flush();

            return $this->redirectToRoute('app_gerersesconges_voirsesconges');
        }

        return $this->render('gerersesconges/nouveauconges.html.twig', [
            'congesdemande' => $congesdemande,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_gerersesconges_detailsconges", methods={"GET"})
     */
    public function show(CongesDemande $congesdemande): Response
    {
        return $this->render('gerersesconges/detailsconges.html.twig', [
            'congesdemande' => $congesdemande,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_gerersesconges_modifierconges", methods={"GET","POST"})
     */
    public function edit(Request $request, CongesDemande $congesdemande, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(NouveauCongesFormType::class, $congesdemande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($congesdemande);
            $entityManager->flush();

            return $this->redirectToRoute('app_gerersesconges_voirsesconges');
        }

        return $this->render('gerersesconges/modifierconges.html.twig', [
            'congesdemande' => $congesdemande,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete/{id}", name="app_gerersesconges_supprimerconges", methods={"DELETE"})
     */
    public function delete(Request $request, CongesDemande $congesdemande): Response
    {
        if ($this->isCsrfTokenValid('delete'.$congesdemande->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($congesdemande);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_gerersesconges_voirsesconges');
    }

}