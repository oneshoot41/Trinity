<?php

namespace App\Form;

use App\Entity\Oeuvres;
use App\Entity\Expositions;
use App\Entity\Artistes;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class ExpositionsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('date_debut')
            ->add('date_fin')
            ->add('nb_vues')
            ->add('description_fr')
            ->add('description_en')
            ->add('oeuvres', EntityType::class, [
                'class' => Oeuvres::class,
                'choice_label' => 'titre',
                'multiple' => true,
                'expanded' => true
            ])
            ->add('ordre')
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
