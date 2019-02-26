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

class OeuvresType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('path', FileType::class)
            ->add('livre')
            ->add('emplacement')
            ->add('description_fr')
            ->add('description_en')
            ->add('type', ChoiceType::class, [
                'choices'  => [
                    'Tableau' => 'Tableau',
                    'Musique' => 'Musique',
                    'Vidéo' => 'Vidéo'
                ]]
            )
            ->add('artiste', EntityType::class, [
                'class' => Artistes::class,
                'choice_label' => 'nom',
                'data' => 'nom',
                'multiple' => false,
                'expanded' =>  false
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Oeuvres::class,
        ]);
    }
}
