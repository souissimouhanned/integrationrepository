<?php

namespace App\Form;

use App\Entity\DetailVoiture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DetailVoitureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Modele')
            ->add('NombrePlace')
            ->add('Valeur')
            ->add('puissance')
            ->add('age')
            ->add('relation')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DetailVoiture::class,
        ]);
    }
}
