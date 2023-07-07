<?php

namespace App\Form;

use App\Entity\Car;
use App\Entity\Fuel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;


class CarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('model', TextType::class, [
                'label' => 'Modèle',
                'attr' => [
                    'placeholder' => 'Modèle du véhicule'
                ]
            ])
            ->add('year', TextType::class, [
                'label' => 'Année',
                'attr' => [
                    'placeholder' => 'Année du véhicule'
                ]
            ])
            ->add('mileage', TextType::class, [
                'label' => 'Kilométrage',
                'attr' => [
                    'placeholder' => 'Kilométrage du véhicule'
                ]
            ])
            ->add('motor', TextType::class, [
                'label' => 'Motorisation',
                'attr' => [
                    'placeholder' => 'Motorisation du véhicule'
                ]
            ])
            ->add('fuel', EntityType::class, [
                'label' => 'Carburant',
                'class' => Fuel::class,
                'choice_label' => 'name'
            ])
            ->add('gearbox', TextType::class, [
                'label' => 'Boîte de vitesse',
                'attr' => [
                    'placeholder' => 'Boîte de vitesse du véhicule'
                ]
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'attr' => [
                    'placeholder' => 'Description du véhicule'
                ]
            ])
            ->add('doors', NumberType::class, [
                'label' => 'Nombre de portes',
                'attr' => [
                    'placeholder' => 'Nombre de portes du véhicule'
                ]
            ])
            ->add('equipments', TextareaType::class, [
                'label' => 'Equipements',
                'attr' => [
                    'placeholder' => 'Equipements du véhicule'
                ]
            ])
            ->add('price', TextType::class, [
                'label' => 'Prix',
                'attr' => [
                    'placeholder' => 'Prix du véhicule'
                ]
            ])
            ->add('picture', FileType::class, [
                'label' => 'Image',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/jpg', 
                            'image/webp',
                        ],
                        'mimeTypesMessage' => 'Veuillez choisir un fichier image valide',
                    ])
                    ]]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Car::class,
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'csrf_token_id'   => 'post_item',
        ]);
    }
}
