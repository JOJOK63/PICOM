<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpKernel\Exception\LengthRequiredHttpException;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Saisir votre email',
                'constraints' => new Length(2, 60),
                'attr' => [
                    'placeholder' => 'email'
                ],
                'required' => true,
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Saisir votre prénom',
                'constraints' => new Length(2, 30),
                'attr' => [
                    'placeholder' => 'prénom'
                ],
                'required' => true,
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Saisir votre nom',
                'constraints' => new Length(2, 30),
                'attr' => [
                    'placeholder' => 'nom'
                ],
                'required' => true,
            ])
            ->add('phone', TextType::class, [
                'label' => 'Saisir votre numéro de téléphone',
                'attr' => [
                    'placeholder' => 'numéro'
                ],
                'required' => true,
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Saisir votre mot de passe',
                'attr' => [
                    'placeholder' => 'mot de passe'
                ],
                'required' => true,
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Le mot de passe doit correspondre.',
                'options' => [
                    'attr' => [
                        'class' => 'password-field',
                        'placeholder' => 'mot de passe']
                ],
                'required' => true,
                'first_options' => ['label' => 'Mot de passe'],
                'second_options' => ['label' => 'Confirmer mot de passe'],
            ])
            ->add('submit', SubmitType::class,
                [
                    'label' => 'Valider',
                ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
