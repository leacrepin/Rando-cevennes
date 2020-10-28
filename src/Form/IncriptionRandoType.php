<?php

namespace App\Form;

use App\Entity\IncriptionRando;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class IncriptionRandoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('email')
            ->add('message')
            ->add('dateDemande')
            ->add('randonnees')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => IncriptionRando::class,
        ]);
    }
}
