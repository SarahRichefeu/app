<?php

namespace App\Controller;

use App\Repository\CommentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(CommentRepository $repo): Response
    {

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'comments' => $repo->findBy(
                ['approuved' => true],
                ['dateAdded' => 'DESC'],
                3
                )
        ]);
    }



    #[Route('/politique-de-confidentalite', name: 'cgu')]    
    public function cgu(): Response
    {
        return $this->render('home/cgu.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
    #[Route('/mentions-legales', name: 'legals')]
    public function legals(): Response
    {
        return $this->render('home/legals.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
