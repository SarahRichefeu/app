<?php

namespace App\Controller;

use App\Repository\GarageRepository;
use App\Repository\ScheduleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdministrationController extends AbstractController
{
    #[Route('/administration', name: 'administration')]
    public function index(ScheduleRepository $schedule, GarageRepository $garage): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        return $this->render('administration/index.html.twig', [
            'controller_name' => 'AdministrationController',
            'hours' => $schedule->findAll(),
            'garage' => $garage->findAll(),
        ]);
    }
}
