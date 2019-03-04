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
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class UsersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('email', EmailType::class, [
            'attr' => ['class' => 'form-control']
        ])

        ->add('nom', TextType::class, [
            'attr' => ['class' => 'form-control']
        ])

        ->add('prenom', TextType::class, [
            'attr' => ['class' => 'form-control']
        ])

        ->add('tel', TextType::class, [
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
            'mapped' => true,
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
            // Configure your form options here
        ]);
    }
}
