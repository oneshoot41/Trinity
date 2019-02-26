<?php

namespace App\Form;

use App\Entity\Oeuvres;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OeuvresType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('path')
            ->add('livre')
            ->add('emplacement')
            ->add('description_fr')
            ->add('description_en')
            ->add('type')
            ->add('artiste')
            ->add('exposition')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Oeuvres::class,
        ]);
    }
}
