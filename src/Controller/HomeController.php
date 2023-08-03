<?php

namespace App\Controller;

use App\Repository\CommentRepository;
use App\Repository\GarageRepository;
use App\Repository\ScheduleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(CommentRepository $repo, ScheduleRepository $schedule, GarageRepository $garage): Response
    {

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'comments' => $repo->findBy(
                ['approuved' => true],
                ['dateAdded' => 'DESC'],
                3
            ),
            'hours' => $schedule->findAll(),
            'garage' => $garage->findAll(),
        ]);
    }



    #[Route('/cgu', name: 'cgu')]    
    public function cgu(ScheduleRepository $schedule, GarageRepository $garage): Response
    {
        return $this->render('home/cgu.html.twig', [
            'controller_name' => 'HomeController',
            'hours' => $schedule->findAll(),
            'garage' => $garage->findAll(),
        ]);
    }

}
