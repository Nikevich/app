<?php
/**
 * Контроллер для админского управления объединениями
 * 
 * TODO поставить доступ только администратору
 */

namespace App\Controller;

use App\Entity\Assosiation;
use App\Form\AssosiationType;
use App\Repository\AssosiationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\{TextType, ChoiceType, CheckboxType, TextareaType};
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('admin/assosiation')]
class AssosiationController extends AbstractController
{
    #[Route('/', name: 'app_admin_assosiation_index', methods: ['GET'])]
    public function index(AssosiationRepository $assosiationRepository): Response
    {
        return $this->render('admin/assosiation/index.html.twig', [
            'assosiations' => $assosiationRepository->findBy([
                'archived' => false,
            ]),
            'archived_assosiations' => $assosiationRepository->findBy([
                'archived' => true,
            ]),
        ]);
    }

    #[Route('/new', name: 'app_admin_assosiation_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $assosiation = new Assosiation();
        $form = $this->createFormBuilder($assosiation)
            ->add('name', TextType::class, [
                'attr' => [
                    'class' => 'form-control']])
            ->add('description', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'rows' => 3]])
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Наука' => 'science',
                    'Спорт' => 'sport',
                    'Культмасс' => 'culture'], 
                'placeholder' => 'Выберите тип',
                'attr' =>[
                    'class' => 'form-select'
                ]])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $assosiation->setCreateDate(new \DateTime());
            if (!$assosiation->isArchived()) $assosiation->setArchived(false);
            $entityManager->persist($assosiation);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_assosiation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/assosiation/new.html.twig', [
            'assosiation' => $assosiation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_assosiation_show', methods: ['GET'])]
    public function show(Assosiation $assosiation): Response
    {
        return $this->render('admin/assosiation/show.html.twig', [
            'assosiation' => $assosiation,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_assosiation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Assosiation $assosiation, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createFormBuilder($assosiation)
            ->add('name', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ]])
            ->add('description', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'rows' => 3
                ]])
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Наука' => 'science',
                    'Спорт' => 'sport',
                    'Культмасс' => 'culture'], 
                'placeholder' => 'Выберите тип',
                'attr' =>[
                    'class' => 'form-select'
               ]])
            ->add('archived', CheckboxType::class, [
                'data' => $assosiation->isArchived(),
                'required' => false
            ])
            ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_assosiation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/assosiation/edit.html.twig', [
            'assosiation' => $assosiation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_assosiation_delete', methods: ['POST'])]
    public function delete(Request $request, Assosiation $assosiation, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$assosiation->getId(), $request->request->get('_token'))) {
            $entityManager->remove($assosiation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_assosiation_index', [], Response::HTTP_SEE_OTHER);
    }
}
