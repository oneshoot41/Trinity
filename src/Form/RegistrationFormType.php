<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('Password', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 3,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
                'attr' => ['class' => 'form-control']
            ])
            ->add('Confirmation', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please Confirm your password',
                    ]),
                ],
                'attr' => ['class' => 'form-control']
            ])

            ->add('nom', TextType::class, [
                'mapped' => false,
                'attr' => ['class' => 'form-control']
            ])

            ->add('prenom', TextType::class, [
                'mapped' => false,
                'attr' => ['class' => 'form-control']
            ])

            ->add('tel', TextType::class, [
                'mapped' => false,
                'attr' => ['class' => 'form-control']
            ])

            ->add('service', ChoiceType::class, [
                'choices'  => [
                    'Direction' => 'Direction',
                    'Communication' => 'Communication',
                    'Technique' => 'Technique',
                    'Assistant' => 'Assistant',
                    'Linguistique' => 'Linguistique'
                ],
                'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please Confirm your password',
                    ]),
                    ],
                    'attr' => ['class' => 'form-control']    
            ])

            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'Admin' => 'ROLE_ADMIN',
                    'Collaborateur' => 'ROLE_USER'
                ],
                'multiple' => true,
                'expanded' => true,
                'attr' => ['class' => 'form-control']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
