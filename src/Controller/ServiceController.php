<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ServiceController extends AbstractController
{
    #[Route('/entretien', name: 'service_entretien')]
    public function entretien(): Response
    {
        return $this->render('service/entretien.html.twig', [
            'controller_name' => 'ServiceController',
        ]);
    }

    #[Route('/services', name: 'services')]
    public function services(): Response
    {
        return $this->render('service/services.html.twig', [
            'controller_name' => 'ServiceController',
        ]);
    }
}
