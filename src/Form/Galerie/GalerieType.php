<?php

namespace App\Form\Galerie;

use App\Entity\Galerie\Categorie;
use App\Entity\Galerie\Galerie;
use App\Entity\Galerie\Theme;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use App\Form\Galerie\FormatType;
use App\Form\Galerie\ImageType;

class GalerieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class)
            ->add('slug', TextType::class)
            ->add('theme', EntityType::class, array(
                    'class' => Theme::class,
                    'choice_label' => 'title',
                    'placeholder' => 'Choisir un théme'
                )
            )
            ->add('categories', EntityType::class, array(
                    'multiple' => true,
                    'class' => Categorie::class,
                    'choice_label' => 'title',
                    'placeholder' => 'Choisir une catégorie'
                )
            )
            ->add('formats', CollectionType::class, array(
                'entry_type'   => FormatType::class,
                'allow_add'    => true,
                'allow_delete' => true,
                'label' => ' '
            ))
            ->add('contenu', TextareaType::class)
            ->add('image', ImageType::class)
            ->add('Enregistrer', SubmitType::class);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Galerie::class,
        ]);
    }
}
