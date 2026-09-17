<?php

namespace App\Form;

use App\Entity\Album;
use App\Entity\Playlist;
use App\Entity\Son;
use App\Entity\Type;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('duration')
            ->add('tracknumber')
            ->add('counter')
            ->add('isExplicite')
            // ->add('albums', EntityType::class, [
            //     'class' => Album::class,
            //     'choice_label' => '',
            //     'multiple' =>true,
            //     'expanded' => true
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Son::class,
        ]);
    }
}
