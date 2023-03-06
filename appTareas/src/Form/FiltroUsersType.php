<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FiltroUsersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre', TextType::class, [
                'required' => false,
            ])
            ->add('email', TextType::class, [
                'required' => false,
            ])
            ->add('roles', ChoiceType::class, [
                'required' => false,
                'choices' => [
                    'Todos' => null,
                    'Administrador' => 'ROLE_ADMIN',
                    'Usuario' => 'ROLE_USER',
                ],
            ])
            ->add('pagina', HiddenType::class) // campo oculto para mantener la página actual
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => null,
        ]);
    }
}
