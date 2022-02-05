<?php

namespace App\Form;

use App\Entity\Timeslot;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TimeslotFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('start',TimeType::class, [
                'label' => 'Heure de début',
                'required' => false,
            ])

            ->add('end', TimeType::class, [
                'label' => 'Heure de fin',
            ])

            ->add('price',MoneyType::class, [
                'label' => 'Prix du créneau',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Entrez son prix',
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Enregistrer',
                'attr' => [
                    'class' => 'btn btn-block btn-danger',
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Timeslot::class,
        ]);
    }
}
