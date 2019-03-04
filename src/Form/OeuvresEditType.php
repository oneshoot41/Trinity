<?php

namespace App\Form;

use App\Entity\Oeuvres;
use App\Entity\Artistes;
use App\Entity\Expositions;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class OeuvresEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', TextType::class, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('livre', CheckboxType::class)
            ->add('description_fr', TextareaType::class, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('description_en', TextareaType::class, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('artiste', EntityType::class, [
                'class' => Artistes::class,
                'choice_label' => 'nom',
                'multiple' => false,
                'expanded' =>  false,
                'attr' => ['class' => 'form-control']
            ])
            ->add('emplacement', ChoiceType::class, [
                'choices' => [
                    'A' => 'A',
                    'B' => 'B',
                    'C' => 'C',
                    'D' => 'D',
                    'E' => 'E',
                    'F' => 'F',
                    'G' => 'G',
                    'H' => 'H',
                    'I' => 'I',
                    'J' => 'J',
                    'Pas encore défini' => 'aucun'
                ],
                'attr' => ['class' => 'form-control']]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Oeuvres::class,
        ]);
    }
}
