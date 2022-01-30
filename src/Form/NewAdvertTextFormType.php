<?php

namespace App\Form;

use App\Entity\AdvertText;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NewAdvertTextFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('advertName', TextType::class, [
                'label' => 'Nom de l\'annonce',
                'required' => true,
            ])
            ->add('createdAt', DateType::class, [
                'label' => 'Date de création',
                'input' => 'datetime_immutable',
                'widget' => 'single_text',
                'required' => true,

                // this is actually the default format for single_text
//                'format' => 'yyyy-MM-dd',
            ])

            ->add('content',TextType::class, [
                'label' => 'Contenu de l\'annonce',
                'required' => true,
            ])
            ->add('broadcastings',BroadcastingFormType::class)
            ->add('submit');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AdvertText::class,
        ]);
    }
}
