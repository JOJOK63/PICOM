<?php

namespace App\Form;

use App\Entity\Broadcasting;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BroadcastingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('createdAt')
            ->add('broadcastStartDate')
            ->add('broadcastEndDate')
            ->add('adverts')
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
