<?php

namespace App\Form;

use App\Entity\Contrat;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContratType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('num_contrat')
            ->add('nom_user')
            ->add('prenom_user')
            ->add('num_tel')
            ->add('code_postal')
            ->add('ville')
            ->add('destinataire')
            ->add('type_contrat')
            ->add('date')
            ->add('nature_contart')
            ->add('contrat')
            ->add('demandeContart')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contrat::class,
        ]);
    }
}
