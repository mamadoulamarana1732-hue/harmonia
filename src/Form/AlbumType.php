<?php

namespace App\Form;

use App\Entity\Album;
use App\Entity\Artist;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;


class AlbumType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('releaseAt')
            ->add('cover')
            ->add('imagePath')
            ->add('imageFile', FileType::class, [
                'mapped' => false,
                'required' => false,
            ])
            ->add('type', ChoiceType::class, [
                'label' => 'Type album',
                'choices'=>[
                    'EP'=>'EP',
                    'SINGLE'=>'SINGLE',
                    'ALBUM'=>'ALBUM'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Album::class,
        ]);
    }
}
