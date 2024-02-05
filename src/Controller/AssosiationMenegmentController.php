<?php

namespace App\Controller;

use App\Entity\Assosiation;
use App\Repository\AssosiationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/assosiation_menegment')]
class AssosiationMenegmentController extends AbstractController
{
    #[Route('/', name: 'app_assosiation_menegment')]
    public function index(AssosiationRepository $assosiationRepository): Response
    {

        // Берем объединения и сортируем по названию
        $assosiations = $assosiationRepository->findBy([], ['name' => 'ASC']);

        // Берем архивированные объединения и сортируем по названию
        $assosiations_archived = $assosiationRepository->findBy([], ['name' => 'ASC']);
        
        return $this->render('assosiation_menegment/index.html.twig', [
            'assosiations' => $assosiations,
            'assosiations_archived' => $assosiations_archived
        ]);

    }
}
