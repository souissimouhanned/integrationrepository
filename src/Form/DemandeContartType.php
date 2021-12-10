<?php

namespace App\Form;

use App\Entity\DemandeContart;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DemandeContartType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom_user')
            ->add('prenom_user')
            ->add('num_tel')
            ->add('ville')
            ->add('code_postal')
            ->add('email')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DemandeContart::class,
        ]);
    }
}
