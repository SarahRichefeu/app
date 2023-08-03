<?php

namespace App\Controller;

use App\Entity\Car;
use App\Form\CarType;
use App\Form\ContactType;
use App\Repository\CarRepository;
use App\Repository\FuelRepository;
use App\Repository\GarageRepository;
use App\Repository\ScheduleRepository;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class CatalogueController extends AbstractController
{

    #[Route('/catalogue', name: 'catalogue')]
    public function index(CarRepository $repository, FuelRepository $fuelRepo, ScheduleRepository $schedule, GarageRepository $garage): Response
    {
        return $this->render('catalogue/index.html.twig', [
            'controller_name' => 'CatalogueController',
            'cars' => $repository->findAll(),
            'fuels' => $fuelRepo->findAll(),
            'hours' => $schedule->findAll(),
            'garage' => $garage->findAll(),
        ]);
    }

    #[Route('catalogue/{id}', name:"car_show", requirements:['id' => '\d+'])]
    public function show(Car $car, Request $request, MailerInterface $mailer, ScheduleRepository $schedule, GarageRepository $garage): Response 
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        $success = [];

        if ($form->isSubmitted() && $form->isValid()) {
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


        return $this->redirectToRoute('catalogue');
        }

        return $this->render('catalogue/show.html.twig', [
            'controller_name' => 'CatalogueShow',
            'car' => $car,
            'form' => $form->createView(),
            'hours' => $schedule->findAll(),
            'garage' => $garage->findAll(),
        ]);
    }


    #[Route('catalogue/add', name:"car_add")]
    public function add(Request $request, CarRepository $repo, SluggerInterface $slugger, ScheduleRepository $schedule, GarageRepository $garage): Response 
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $car = new Car();
        $formCar = $this->createForm(CarType::class, $car);
        // faire un createForm de carImage pour le carrousel

        $formCar->handleRequest($request);

        if ($formCar->isSubmitted() && $formCar->isValid()) {
            $picture = $formCar->get('picture')->getData();

            if ($picture) {
                $originalFilename = pathinfo($picture->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$picture->guessExtension();

                try {
                    $picture->move(
                        $this->getParameter('pictures_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    throw new \Exception('Erreur lors de l\'upload de l\'image');
                }

                $car->setPicture($newFilename);
            }

            $repo->save($car, true);
            return $this->redirectToRoute('catalogue');
        }  

        $title = 'Ajouter une annonce';
        $btn = 'Ajouter';

        return $this->render('catalogue/form.html.twig', [
            'controller_name' => 'CatalogueAdd',
            'formCar' => $formCar->createView(),
            'title' => $title, 
            'btn' => $btn,
            'hours' => $schedule->findAll(),
            'garage' => $garage->findAll(),
        ]);
    }


    #[Route('catalogue/{id}/edit', name:"car_edit", requirements:['id' => '\d+'])]
    public function edit(Car $car, Request $request, CarRepository $repo, SluggerInterface $slugger, ScheduleRepository $schedule, GarageRepository $garage): Response 
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $formCar = $this->createForm(CarType::class, $car);
        $formCar->handleRequest($request);

        if ($formCar->isSubmitted() && $formCar->isValid()) {
            $picture = $formCar->get('picture')->getData();

            if ($picture) {
                $originalFilename = pathinfo($picture->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$picture->guessExtension();

                try {
                    $picture->move(
                        $this->getParameter('pictures_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    throw new \Exception('Erreur lors de l\'upload de l\'image');
                }

                $car->setPicture($newFilename);
            }

            $repo->save($car, true);
            return $this->redirectToRoute('catalogue');
        }

        $title = 'Modifier une annonce';
        $btn = "Modifier";
        return $this->render('catalogue/form.html.twig', [
            'controller_name' => 'CatalogueEdit',
            'formCar' => $formCar->createView(),
            'title' => $title,
            'btn' => $btn,
            'hours' => $schedule->findAll(),
            'garage' => $garage->findAll(),
        ]);
    }

    #[Route('catalogue/{id}/delete', name:"car_delete", requirements:['id' => '\d+'])]
    public function delete(Car $car, CarRepository $repo): Response 
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $repo->remove($car, true);
        return $this->redirectToRoute('catalogue');
    }
}
