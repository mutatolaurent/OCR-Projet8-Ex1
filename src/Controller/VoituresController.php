<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Voiture;
use App\Repository\VoitureRepository;

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
}
