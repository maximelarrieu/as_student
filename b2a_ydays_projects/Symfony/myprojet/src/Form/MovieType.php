<?php

namespace App\Form;

use App\Entity\Categories;
use App\Entity\Movie;
use App\Entity\People;
use Doctrine\DBAL\Types\TextType;
use phpDocumentor\Reflection\Type;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MovieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', null, [
                'label' => 'Title'
            ])
            ->add('releasedAt', DateType::class, [
                'label' => 'Release At'
            ])
            ->add('image', UrlType::class, [
                'label' => "Picture Link"
            ])
            ->add('synopsis', TextareaType::class)
            ->add('categories', EntityType::class, [
                'class' => Categories::class,
                'multiple' => true
            ])
            ->add('people', EntityType::class, [
                'class' => People::class,
                'multiple' => true
            ])
            ->add('submit', SubmitType::class, [
               'label_format' => 'Continue',
                'attr' => [
                    'class' => 'btn btn-outline-success'
                ]
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Movie::class,
        ]);
    }
}
