<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

use AppBundle\Form\GenderType;

class RechercheType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('zone', TextType::class, array(
                  'attr'  => array(
                      'class' => 'form-control select-zone',
                      'autocomplete'  => true,
                      'placeholder' => 'Entrez la zone de recherche'
                  ),
                  'required'  => true
            ))
            ->add('domaine', TextType::class, array(
                  'attr'  => array(
                      'class' => 'form-control select-domaine',
                      'autocomplete'  => true,
                      'placeholder' => 'Entrez le domaine de recherche'
                  ),
                  'required'  => true
            ))
            ->add('page', HiddenType::class, array(
              'data' => '1',
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Recherche'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_recherche';
    }


}
