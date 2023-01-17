<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConcepteurdusiteController extends AbstractController
{
    #[Route('/concepteurdusite', name: 'app_concepteurdusite')]
    public function index(): Response
    {
        return $this->render('concepteurdusite/index.html.twig', [
            'controller_name' => 'ConcepteurdusiteController',
        ]);
    }
}
