<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Form\CommentType;
use App\Repository\CommentRepository;
use App\Repository\GarageRepository;
use App\Repository\ScheduleRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommentController extends AbstractController
{
    #[Route('/comment', name: 'comment')]
    public function index(CommentRepository $repo, ScheduleRepository $schedule, GarageRepository $garage): Response
    {
        return $this->render('comment/index.html.twig', [
            'controller_name' => 'CommentController',
            'comments' => $repo->findAll(),
            'hours' => $schedule->findAll(),
            'garage' => $garage->findAll(),
        ]);
    }

    #[Route('/comment/new', name: 'comment_add')]
    public function add(Request $request, CommentRepository $repo, ScheduleRepository $schedule, GarageRepository $garage): Response 
    {
        $comment = new Comment();

        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $comment->setDateAdded(new \DateTime());
            $comment->setApprouved(false);
            $repo->save($comment, true);

            return $this->redirectToRoute("app_home");
        }

        return $this->render('comment/form.html.twig', [
            'controller_name' => 'CommentNew',
            'form' => $form->createView(),
            'hours' => $schedule->findAll(),
            'garage' => $garage->findAll(),
        ]);
    }

    #[Route('/comment/verification', name: 'comment_verification')]
    public function approuve(CommentRepository $repo, ScheduleRepository $schedule, GarageRepository $garage): Response 
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $comments = $repo->findBy(['approuved' => false]);

        return $this->render('comment/verification.html.twig', [
            'controller_name' => 'CommentVerification',
            'comments' => $comments,
            'hours' => $schedule->findAll(),
            'garage' => $garage->findAll(),
        ]);
    }

    #[Route('/comment/{id}/approuve', name: 'comment_approve')]
    public function approuveComment(Comment $comment, CommentRepository $repo): Response 
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $comment->setApprouved(true);
        $repo->save($comment, true);

        return $this->redirectToRoute('comment_verification');
    }

    #[Route('/comment/{id}/delete', name: 'comment_delete')]   
    public function delete(Comment $comment, CommentRepository $repo): Response 
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $repo->remove($comment, true);

        return $this->redirectToRoute('comment_verification');
    }
}
