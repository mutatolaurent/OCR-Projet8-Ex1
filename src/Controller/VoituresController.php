<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Voiture;
use App\Form\VoitureType;
use App\Repository\VoitureRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Doctrine\ORM\EntityManagerInterface;

final class VoituresController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(VoitureRepository $repository): Response
    {
        $voitures = $repository->findAll();
        //dd($voitures);

        return $this->render('voitures/accueil.html.twig', [
            'voitures' => $voitures,
        ]);
    }

    #[Route('/voiture/{id}', name: 'app_voiture_show', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function show(?Voiture $voiture): Response
    {
        // Si la voiture n'existe pas en base de données l'utilisateur est redirigé vers la HP
        if (!$voiture) {
            // throw new NotFoundHttpException("La voiture demandée n'existe pas.");
            return $this->redirectToRoute('app_home');
        }

        return $this->render('voitures/show.html.twig', [
            'voiture' => $voiture,
        ]);
    }

    #[Route('/voiture/{id}/supprimer', name: 'app_voiture_remove', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function remove(?Voiture $voiture, EntityManagerInterface $manager): Response
    {
        // Si la voiture n'existe pas en base de données on redirige vers la HP
        if (!$voiture) {
            return $this->redirectToRoute('app_home');
        }

        // Suppression de la BD
        $manager->remove($voiture);
        $manager->flush();

        // redirection vers la HP
        return $this->redirectToRoute('app_home');
    }

    #[Route('/voiture/ajouter', name: 'app_voiture_new', methods: ['GET','POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Création de l'objet voiture
        $voiture = new Voiture();
        $form = $this->createForm(VoitureType::class, $voiture);

        // Gestion de la soumission du formulaire et redirection vers la HP si tout est OK
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($voiture);
            $entityManager->flush();
            return $this->redirectToRoute('app_voiture_show', ['id' => $voiture->getId()]);
        }

        // Affichage de la vue du formulaire
        return $this->render('voitures/new.html.twig', [
            'form' => $form,
        ]);
    }

}
