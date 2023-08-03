<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\GarageRepository;
use App\Repository\ScheduleRepository;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserController extends AbstractController
{
    #[Route('/user', name: 'user')]
    public function index(UserRepository $repo, ScheduleRepository $schedule, GarageRepository $garage): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        return $this->render('user/index.html.twig', [
            'controller_name' => 'userController',
            'users' => $repo->findByRole('ROLE_USER'),
            'hours' => $schedule->findAll(),
            'garage' => $garage->findAll(),
        ]);
    }

    #[Route('/user/new', name: 'new_user')]
    public function new(Request $request, UserRepository $repo, UserPasswordHasherInterface $passwordHasher, ScheduleRepository $schedule, GarageRepository $garage): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $user->setPassword($passwordHasher->hashPassword($user, $user->getPassword()));
            $user->setRoles(['ROLE_USER']);
            $repo->save($user, true);
            return $this->redirectToRoute('user');
        }

        $title = "Ajouter un employé";
        $btn = "Ajouter";

        return $this->render('user/form.html.twig', [
            'controller_name' => 'userController',
            'form' => $form->createView(),
            'title' => $title,
            'btn' => $btn,
            'hours' => $schedule->findAll(),
            'garage' => $garage->findAll(),
        ]);
    }

    #[Route('/user/edit/{id}', name: 'edit_user', requirements: ['id' => '\d+'])]
    public function edit(Request $request, User $user, UserRepository $repo, UserPasswordHasherInterface $passwordHasher, ScheduleRepository $schedule, GarageRepository $garage): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword($passwordHasher->hashPassword($user, $user->getPassword()));
            $repo->save($user, true);
            return $this->redirectToRoute('user');
        }

        $title = "Modifier un employé";
        $btn = "Modifier";

        return $this->render('user/form.html.twig', [
            'controller_name' => 'userController',
            'form' => $form->createView(),
            'title' => $title,
            'btn' => $btn,
            'hours' => $schedule->findAll(),
            'garage' => $garage->findAll(),
        ]);
    }

    #[Route('/user/delete/{id}', name: 'delete_user', requirements: ['id' => '\d+'])]
    public function delete(User $user, UserRepository $repo): Response 
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $repo->remove($user, true);
        return $this->redirectToRoute('user');
    }
}