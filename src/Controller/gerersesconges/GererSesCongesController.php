<?php

namespace App\Controller\gerersesconges;

use App\Entity\CongesDemande;
use App\Entity\Delegation;
use App\Entity\User;
use App\Form\NouveauCongesFormType;
use App\Repository\CongesDemandeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
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
    public function index(CongesDemandeRepository $congesDemandeRepository, Request $request, ManagerRegistry $doctrine, EntityManagerInterface $entityManager): Response
    {
        $idUserConnected = $this->getUser()->getId();

        // Récupération des demandes de congés où l'id du bénéficiaire est égal à l'id de l'utilisateur connecté
        $congesdemande = $congesDemandeRepository->findBy(['idBeneficiaire' => $idUserConnected]);

        return $this->render('gerersesconges/voirsesconges.html.twig', [
            'congesdemande' => $congesdemande,
        ]);
    }

    /**
     * @Route("/voirsescongesdelegue", name="app_gerersesconges_voirsescongesdelegue", methods={"GET"})
     */
    public function delegue(CongesDemandeRepository $congesDemandeRepository, Request $request, ManagerRegistry $doctrine, EntityManagerInterface $entityManager): Response
    {
        $idUserConnected = $this->getUser()->getId();

        // Récupération des demandes de congés où l'id du bénéficiaire est égal à l'id de l'utilisateur connecté
        $congesdemande = $congesDemandeRepository->findBy(['idPoseur' => $idUserConnected]);

        return $this->render('gerersesconges/voirsescongesdelegue.html.twig', [
            'congesdemande' => $congesdemande,
        ]);
    }

    /**
     * @Route("/nouveauconges", name="app_gerersesconges_nouveauconges", methods={"GET","POST"})
     */
    public function new(Request $request, ManagerRegistry $doctrine, EntityManagerInterface $entityManager): Response
    {
        $congesdemande = new CongesDemande();

        $idUserConnected = $this->getUser()->getId();
        $nomUserConnected = $this->getUser()->getNomU();
        $pnomUserConnected = $this->getUser()->getPnomU();


    //récuperation des délégations de l'entité Delegation par rapport a l'id de l'utilisateur connecté

        $repository = $doctrine->getRepository(Delegation::class);
        $query = $repository->createQueryBuilder('d')
            ->where('d.idUserDelegue = :idUserConnected')
            ->setParameter('idUserConnected', $idUserConnected)
            ->getQuery();
        $postQuery = $query->getResult();


    //Triage du tableau post querry pour n'avoir que les id utilisateurs déléguant

        $delegants = array();
        $delegants = array_map(function ($result) {
            return $result->getIdUserDelegant();
        }, $postQuery);


    //Récupération du nom et prénom des utilisateur déléguant grâce a l'id des utilisateurs déléguant

        $userRepository = $doctrine->getRepository(User::class);
        $userInfo = array();
        foreach ($delegants as $delegant) {
            $user = $userRepository->find($delegant);
            $userInfo[] = array(
                'nom' => $user->getNomU(),
                'prenom' => $user->getPnomU(),
            );
        }
    //Concaténation du nom et du prénom en une seule colonne pour simplifier l'affichage dans le formulaire

        $delegationFromController = array_map(function ($userInfo) {
            return $userInfo['nom'] . ' ' . $userInfo['prenom'];
        }, $userInfo);


        $form = $this->createForm(NouveauCongesFormType::class, $congesdemande, [
            'delegationFromController' => $delegationFromController
        ]);
        $form->handleRequest($request);



        if ($form->isSubmitted() && $form->isValid()) {





            $idUserDelegueAfterForm = $congesdemande->getListDelegationFromForm();
            $delegationBoolFromForm = $congesdemande->isDelegationBoolFromForm();



            if ($delegationBoolFromForm = true) {

            //On charge dans $keys et $values les clées et valeur de delegationFromController

                $keys = array_keys($delegationFromController);
                $values = array_values($delegationFromController);
                foreach ($keys as $index => $arraykeys) {
                    if ($arraykeys == $idUserDelegueAfterForm) {

                        $nomPrenom = $values[$index];
                        $congesdemande->setNomPrenomBeneficiaire($nomPrenom);
                        $nomPrenomTableau = explode(' ', $nomPrenom);
                        $nom = $nomPrenomTableau[0];
                        $prenom = $nomPrenomTableau[1];

                    // Rechercher l'utilisateur dans la table User
                        $userRepository = $doctrine->getRepository(User::class);
                        $query = $userRepository->createQueryBuilder('u')
                            ->where('u.nomU = :nom')
                            ->andWhere('u.pnomU = :prenom')
                            ->setParameter('nom', $nom)
                            ->setParameter('prenom', $prenom)
                            ->getQuery();
                        $user = $query->getOneOrNullResult();

                        if ($user) {
                            $idBeneficiaire = $user->getId();
                            $congesdemande->setIdbeneficiaire($idBeneficiaire);
                            $congesdemande->setIdPoseur($idUserConnected);
                            $nomPrenomPoseur = $nomUserConnected . $pnomUserConnected;
                            $congesdemande->setNomPrenomPoseur($nomPrenomPoseur);
                        } else {
                            //todo faire une erreur si aucun utilisateur a été trouvé dans la base de donnée
                        }


                    } else {
                        //todo faire une erreur pour si l'id reçu du formulaire n'est égal a aucun id de delegationFromController
                    }
                }
            }
            elseif($delegationBoolFromForm = false){
                $congesdemande->setIdBeneficiaire($idUserConnected);
                $congesdemande->setIdPoseur($idUserConnected);

            }
            else{
                //todo faire une erreur pour si le boolean retourne rien
            };



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