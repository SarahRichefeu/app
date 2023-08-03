<?php

namespace App\Controller;

use App\Form\ContactType;
use App\Repository\GarageRepository;
use App\Repository\ScheduleRepository;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact')]
    public function index(Request $request, MailerInterface $mailer, ScheduleRepository $schedule, GarageRepository $garage): Response
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $contact = $form->getData();

            $email = (new TemplatedEmail())
                ->from('v.parrot@sarahrichefeu.fr')
                ->to('v.parrot@sarahrichefeu.fr')    
                ->subject($contact['subject'])
                ->htmlTemplate('emails/contact.html.twig')
                ->context([
                    'contact' => $contact
                ]);

            $mailer->send($email);

            return $this->redirectToRoute('app_home');
        }

        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
            'formView' => $form->createView(),
            'hours' => $schedule->findAll(),
            'garage' => $garage->findAll(),
        ]);
    }
}
