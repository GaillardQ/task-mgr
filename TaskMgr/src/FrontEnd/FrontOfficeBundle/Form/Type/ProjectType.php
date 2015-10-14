<?php

// src/FrontEnd/FrontOfficeBundle/Form/Type/ProjectType.php
namespace FrontEnd\FrontOfficeBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('language')
            ->add('workFor')
            ->add('save', 'submit', array('label' => 'Enregistrer le projet'));
    }

    public function getName()
    {
        return 'project';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FrontEnd\FrontOfficeBundle\Entity\Project',
        ));
    }
}