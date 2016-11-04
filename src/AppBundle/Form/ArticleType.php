<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

use AppBundle\Entity\Image;
use AppBundle\Form\ImageType;


class ArticleType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
              ->add('titre', TextType::class, array(
                    'attr'  => array(
                        'class' => 'form-control',
                        'autocomplete'  => 'off'
                    )
              ))
              ->add('resume', TextareaType::class, array(
                    'attr'  => array(
                        'class' => 'form-control'
                    )
              ))
              ->add('tags', TextareaType::class, array(
                    'attr'  => array(
                        'class' => 'form-control'
                    )
              ))
              ->add('rubriques', null, array(
                    'attr'  => array(
                        'class' => 'form-control'
                    )
              ))
              //->add('publicationAt')->add('modificationAt') ckeditor form-control
              ->add('statut')
              ->add('contenu', null, array(
                'attr'  => array(
                  'class' => 'ckeditor form-control'
                )
            ))
            ->add('image', ImageType::class)
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Article'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_article';
    }


}
