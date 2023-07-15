<?php

namespace App\Form;

use App\Entity\Comment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                "label" => "Prénom et nom",
                "attr" => [
                    "placeholder" => "Votre prénom et nom",
                    'required' => 'required'
                ]
            ])
            ->add('note', ChoiceType::class, [
                "label" => "Note",
                "choices" => [
                    "⭐" => 1,
                    "⭐⭐" => 2,
                    "⭐⭐⭐" => 3,
                    "⭐⭐⭐⭐" => 4,
                    "⭐⭐⭐⭐⭐" => 5
                ],
                "attr" => [

                    'required' => 'required'
                ]
            ])
            ->add('message', TextareaType::class, [
                "label" => "Commentaire",
                "attr" => [
                    "placeholder" => "Votre commentaire",
                    'required' => 'required'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Comment::class,
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'csrf_token_id'   => 'post_item',
        ]);
    }
}
