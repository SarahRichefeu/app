<?php

namespace App\Controller;

use App\Entity\Service;
use App\Form\ServiceType;
use App\Repository\ServiceRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
    public function editServices(Request $request, Service $service, ServiceRepository $repo): Response
    {
        $form = $this->createForm(ServiceType::class, $service);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $repo->save($service, true);
            return $this->redirectToRoute('services');
        }

        return $this->render('service/service_form.html.twig', [
            'controller_name' => 'ServiceController',
            'formView' => $form->createView()
        ]);

    }

    #[Route('/services/add', name: 'services_add')]
    public function addServices(Request $request, ServiceRepository $repo): Response
    {
        $service = new Service();
        $form = $this->createForm(ServiceType::class, $service);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $repo->save($service, true);
            return $this->redirectToRoute('services');
        }

        return $this->render('service/service_form.html.twig', [
            'controller_name' => 'ServiceController',
            'formView' => $form->createView()
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
