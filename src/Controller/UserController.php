<?php

namespace App\Controller;

use App\Form\UserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class UserController extends AbstractController
{
    #[Route('/user/new', name: 'new_user')]
    public function new(AuthenticationUtils $authenticationUtils, Request $request): Response
    {
        return $this->render('user/login.html.twig', [
            'controller_name' => 'userController',
        ]);
    }

    #[Route('/user/edit', name: 'edit_user')]
    public function edit(AuthenticationUtils $authenticationUtils, Request $request): Response
    {
        return $this->render('user/login.html.twig', [
            'controller_name' => 'userController',
        ]);
    }

    #[Route('/user/delete/{id}', name: 'edit_user')]
    public function delete(AuthenticationUtils $authenticationUtils, Request $request): Response
    {
        return $this->render('user/login.html.twig', [
            'controller_name' => 'userController',
        ]);
    }
}
