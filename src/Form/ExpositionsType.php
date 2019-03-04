<?php

namespace App\Form;

use App\Entity\Oeuvres;
use App\Entity\Expositions;
use App\Entity\Artistes;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class ExpositionsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('date_debut', DateTimeType::class, [
                'attr' => ['class' => 'input-group']
            ])
            ->add('date_fin', DateTimeType::class, [
                'attr' => ['class' => 'input-group']
            ])
            ->add('description_fr', TextareaType::class, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('description_en', TextareaType::class, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('ordre', TextType::class, [
                'required' => false,
                'attr' => ['maxlength' => '5',
                'class' => 'form-control']
            ])
            ->add('oeuvres', EntityType::class, [
                'class' => Oeuvres::class,
                'choice_label' => 'titre',
                'multiple' => true,
                'expanded' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Expositions::class,
            'entry_options' => [
                'attr' => ['class' => 'titre']
        ]]);
    }
}
