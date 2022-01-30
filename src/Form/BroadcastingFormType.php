<?php

namespace App\Form;

use App\Entity\Broadcasting;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BroadcastingFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('broadcastStartDate')
            ->add('broadcastEndDate')
            ->add('areas')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Broadcasting::class,
        ]);
    }
}
