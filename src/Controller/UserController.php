<?php

namespace App\Controller;

use App\Form\UserType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    #[Route('/login', name: 'login')]
    public function login(): Response
    {
        $form = $this->createForm(UserType::class);

        return $this->render('user/login.html.twig', [
            'controller_name' => 'userController',
            'formView' => $form->createView(),
        ]);
    }
}
