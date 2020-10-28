<?php

// src/Form/Type/InscriptionRandoType.php
namespace App\Form\Type;

use App\Entity\Randonnee;
use App\Repository\RandonneeRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InscriptionRandoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class)
            ->add('email', TextType::class)
            ->add('message', TextType::class)
            ->add('randonnees', EntityType::class, [
                'class' => Randonnee::class,
                'choice_label' => 'titre',
                'multiple' => true,
                'query_builder' => function (RandonneeRepository $repo) {
                    return $repo->createQueryBuilder('u')
                        ->orderBy('u.dateRando', 'ASC');
                },
                'data' => [$options['randoDefault']]
            ])
            ->add('save', SubmitType::class, ['label' => 'Inscription'])
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'randoDefault' => null,
        ));
    }
}