<?php

namespace App\Controller;

use App\Repository\CarRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
