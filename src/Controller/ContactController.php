<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\ContactRepository;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact')]
    public function index(Request $request, ContactRepository $repo, MailerInterface $mailer): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $contact->setDate(new \DateTime());
            $repo->save($contact, true);

            $email = (new TemplatedEmail())
                ->from($contact->getEmail())
                ->to('v.parrot@sarahrichefeu.fr')    
                ->subject($contact->getSubject())
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
        ]);
    }
}
