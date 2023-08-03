<?php

namespace App\Controller;

use App\Form\LoginType;
use App\Repository\GarageRepository;
use App\Repository\ScheduleRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route('/login', name: 'login')]
    public function login(AuthenticationUtils $authenticationUtils, Request $request, ScheduleRepository $schedule, GarageRepository $garage): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        $form = $this->createForm(LoginType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

        }

        return $this->render('security/login.html.twig', [
            'controller_name' => 'SecurityController',
            'formView' => $form->createView(),
            'error' => $error,
            'last_username' => $lastUsername,
            'hours' => $schedule->findAll(),
            'garage' => $garage->findAll(),
        ]);
    }

    #[Route('/logout', name: 'logout')]
    public function logout()
    {
    }
}

