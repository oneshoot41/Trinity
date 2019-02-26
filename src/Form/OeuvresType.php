<?php

namespace App\Form;

use App\Entity\Oeuvres;
<<<<<<< HEAD
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
=======
use App\Entity\Artistes;
use App\Entity\Expositions;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
>>>>>>> 2e56486c2326df871754e56d9f8ae2b9f8fa04bc

class OeuvresType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
<<<<<<< HEAD
            ->add('path')
=======
            ->add('path', FileType::class)
>>>>>>> 2e56486c2326df871754e56d9f8ae2b9f8fa04bc
            ->add('livre')
            ->add('emplacement')
            ->add('description_fr')
            ->add('description_en')
<<<<<<< HEAD
            ->add('type')
            ->add('artiste')
            ->add('exposition')
        ;
=======
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
>>>>>>> 2e56486c2326df871754e56d9f8ae2b9f8fa04bc
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Oeuvres::class,
        ]);
    }
}
