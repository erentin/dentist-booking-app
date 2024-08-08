<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DentistController extends AbstractController
{
    #[Route('/dentist', name: 'app_dentist')]
    public function index(): Response
    {
        return $this->render('dentist/index.html.twig', [
            'controller_name' => 'DentistController',
        ]);
    }
}
