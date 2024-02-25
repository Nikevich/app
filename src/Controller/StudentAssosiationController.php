<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/assosiation')]
class StudentAssosiationController extends AbstractController
{
    #[Route('/', name: 'app_student_assosiation')]
    public function index(): Response
    {
        return $this->render('student_assosiation/index.html.twig', [
            'controller_name' => 'StudentAssosiationController',
        ]);
    }
}
