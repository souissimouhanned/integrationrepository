<?php

namespace App\Form;

use App\Entity\Voiture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Captcha\Bundle\CaptchaBundle\Form\Type\CaptchaType;
use Captcha\Bundle\CaptchaBundle\Validator\Constraints\ValidCaptcha;


class VoitureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('CinUtilisateur')
            ->add('Matricule')
            ->add('Marque')
            ->add('CarteGrise')
            ->add('detailVoiture')
            ->add('CaptchaCode',CaptchaType::class,[
                'captchaConfig'=>'ExampleCaptchaUserRegistration',
                'constraints'=>[
                    new ValidCaptcha([
                        'message'=>'You should agree to our terms',
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Voiture::class,
        ]);
    }
}
