<?php

namespace App\Controller;

use App\Entity\Car;
use App\Form\CarType;
use App\Repository\CarRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\String\Slugger\SluggerInterface;

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
    public function show(Car $car): Response {
        return $this->render('catalogue/show.html.twig', [
            'car' => $car
        ]);
    }


    #[Route('catalogue/add', name:"car_add")]
    public function add(Request $request, CarRepository $repo, SluggerInterface $slugger): Response {

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
            'formCar' => $formCar->createView(),
            'title' => $title, 
            'btn' => $btn
        ]);
    }


    #[Route('catalogue/{id}/edit', name:"car_edit", requirements:['id' => '\d+'])]
    public function edit(Car $car, Request $request, CarRepository $repo, SluggerInterface $slugger): Response 
    {
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
            'formCar' => $formCar->createView(),
            'title' => $title,
            'btn' => $btn
        ]);
    }

    #[Route('catalogue/{id}/delete', name:"car_delete", requirements:['id' => '\d+'])]
    public function delete(Car $car, CarRepository $repo): Response 
    {
        $repo->remove($car, true);
        return $this->redirectToRoute('catalogue');
    }
}
