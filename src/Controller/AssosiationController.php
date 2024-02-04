<?php

namespace App\Controller;

use App\Entity\Assosiation;
use App\Form\AssosiationType;
use App\Repository\AssosiationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/assosiation')]
class AssosiationController extends AbstractController
{
    #[Route('/', name: 'app_assosiation_index', methods: ['GET'])]
    public function index(AssosiationRepository $assosiationRepository): Response
    {
        return $this->render('assosiation/index.html.twig', [
            'assosiations' => $assosiationRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_assosiation_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $assosiation = new Assosiation();
        $form = $this->createForm(AssosiationType::class, $assosiation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($assosiation);
            $entityManager->flush();

            return $this->redirectToRoute('app_assosiation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('assosiation/new.html.twig', [
            'assosiation' => $assosiation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_assosiation_show', methods: ['GET'])]
    public function show(Assosiation $assosiation): Response
    {
        return $this->render('assosiation/show.html.twig', [
            'assosiation' => $assosiation,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_assosiation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Assosiation $assosiation, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AssosiationType::class, $assosiation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_assosiation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('assosiation/edit.html.twig', [
            'assosiation' => $assosiation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_assosiation_delete', methods: ['POST'])]
    public function delete(Request $request, Assosiation $assosiation, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$assosiation->getId(), $request->request->get('_token'))) {
            $entityManager->remove($assosiation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_assosiation_index', [], Response::HTTP_SEE_OTHER);
    }
}
