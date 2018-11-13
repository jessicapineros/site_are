<?php

namespace App\Form;

use App\Entity\DatesFormations;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Category;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class DatesFormationsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date', TextType::class, array(
              'label' => 'Date et/ou lieu de Formation'
            ))
            ->add('category', EntityType::class, array(
              'class' => Category::class,
              'label' => 'Type de formation',
              'placeholder' => 'Choisissez une option',
              'choice_label' => 'title'
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DatesFormations::class,
        ]);
    }
}
