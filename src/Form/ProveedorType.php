<?php

namespace App\Form;

use App\Entity\Proveedor;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProveedorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Nombre')
            ->add('correo', EmailType::class)
            ->add('telefono', IntegerType::class)
            ->add('tipo', ChoiceType::class,
            [
                'choices' =>
                [
                    'hotel' => 'hotel',
                    'pista' => 'pista',
                    'complemento' => 'complemento'
                ]
            ])
            ->add('activo')
            ->add('Enviar', SubmitType::class);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Proveedor::class,
        ]);
    }
}
