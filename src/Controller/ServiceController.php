<?php

namespace App\Controller;

use App\Entity\Service;
use App\Form\ServiceType;
use App\Repository\ServiceRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class ServiceController extends AbstractController
{
    #[Route('/services', name: 'services')]
    public function services(ServiceRepository $repo): Response
    {
        return $this->render('service/services.html.twig', [
            'controller_name' => 'ServiceController',
            'services' => $repo->findAll()
        ]);

    }

    #[Route('/services/edit/{id}', name: 'services_edit', requirements: ['id' => '\d+'])]
    public function editServices(Request $request, Service $service, ServiceRepository $repo, SluggerInterface $slugger): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $form = $this->createForm(ServiceType::class, $service);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $image = $form->get('image')->getData();
            if ($image) {
                $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$image->guessExtension();

                try {
                    $image->move(
                        $this->getParameter('pictures_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    throw new \Exception('Erreur lors de l\'upload de l\'image');
                }

                $service->setImage($newFilename);
            }


            $repo->save($service, true);
            return $this->redirectToRoute('services');
        }

        $title = "Modifier une prestation";
        $btn = "Modifier";

        return $this->render('service/service_form.html.twig', [
            'controller_name' => 'ServiceController',
            'formView' => $form->createView(),
            'title' => $title,
            'btn' => $btn
        ]);

    }

    #[Route('/services/add', name: 'services_add')]
    public function addServices(Request $request, ServiceRepository $repo, SluggerInterface $slugger): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $service = new Service();
        $form = $this->createForm(ServiceType::class, $service);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $image = $form->get('image')->getData();

            if ($image) {
                $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$image->guessExtension();

                try {
                    $image->move(
                        $this->getParameter('pictures_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    throw new \Exception('Erreur lors de l\'upload de l\'image');
                }

                $service->setImage($newFilename);
            }

            $repo->save($service, true);
            return $this->redirectToRoute('services');
        }

        $title = "Ajouter une prestation";
        $btn = "Ajouter";

        return $this->render('service/service_form.html.twig', [
            'controller_name' => 'ServiceController',
            'formView' => $form->createView(),
            'title' => $title,
            'btn' => $btn
        ]);

    }

    #[Route('/registration', name: 'registration')]
    public function registration(): Response
    {
        return $this->render('service/registration.html.twig', [
            'controller_name' => 'ServiceController',
        ]);
    }


    #[Route('/rachat', name: 'rachat')]
    public function rachat(): Response
    {
        return $this->render('service/rachat.html.twig', [
            'controller_name' => 'ServiceController',
        ]);
    }

}
