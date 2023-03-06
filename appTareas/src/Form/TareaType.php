<?php

namespace App\Form;

use App\Entity\EstadoTarea;
use  App\Entity\Tarea;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TareaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre', TextType::class)
            ->add('descripcion', TextType::class)
            ->add('estado', EntityType::class, [
                'class' => EstadoTarea::class,
                'choice_label' => 'nombre',
                'label' => 'Estado',
                'required' => true,
            ])
            ->add('usuario', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'nombre',
                'label' => 'User',
                'required' => true,
            ])
        ;
    }

    // Configura el tipo de formulario asignandole la clase TareaFixtures
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tarea::class,
        ]);
    }
}
