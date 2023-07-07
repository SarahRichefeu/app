<?php

namespace App\Controller;

use App\Entity\Car;
use App\Form\CarType;
use App\Repository\CarRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CatalogueController extends AbstractController
{
    #[Route('/catalogue', name: 'catalogue')]
    public function index(CarRepository $repository): Response
    {
        return $this->render('catalogue/index.html.twig', [
            'controller_name' => 'CatalogueController',
            'cars' => $repository->findAll(),
        ]);
    }

    #[Route('catalogue/{id}', name:"car_show", requirements:['id' => '\d+'])]
    public function show(int $id): Response {
        return $this->render('catalogue/show.html.twig', [
            'id' => $id
        ]);
    }


    #[Route('catalogue/add', name:"car_add")]
    public function add(Request $request, CarRepository $repo): Response {

        $car = new Car();
        $form = $this->createForm(CarType::class, $car);

        $form->handleRequest($request);

        if ($form->isValid() && $form->isSubmitted()) {
            $repo->save($car, true);

            return $this->redirectToRoute('catalogue');
        }  

        return $this->render('catalogue/add.html.twig', [
            'formView' => $form->createView()
        ]);
    }


    #[Route('catalogue/{id}/edit', name:"car_edit", requirements:['id' => '\d+'])]
    public function edit(int $id): Response {
        return $this->render('catalogue/edit.html.twig', [
            'id' => $id
        ]);
    }

    #[Route('catalogue/{id}/delete', name:"car_delete", requirements:['id' => '\d+'])]
    public function delete(int $id): Response {
        return $this->render('catalogue/delete.html.twig', [
            'id' => $id
        ]);
    }
}
