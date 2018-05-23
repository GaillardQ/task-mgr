<?php

// src/FrontEnd/FrontOfficeBundle/Form/Type/ProjectType.php
namespace FrontEnd\FrontOfficeBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array('label' => 'Description de la tâche'))
            ->add('comment', 'textarea', array('label' => 'Commentaire', 'attr' => array('rows' => 4)))
            ->add('state', 'entity', array(
                'class' => 'FrontEndFrontOfficeBundle:Task_State',
                'choice_label' => 'name',
                'label' => 'Avancement'
            ))
            ->add('priority', 'entity', array(
                'class' => 'FrontEndFrontOfficeBundle:Task_Priority',
                'choice_label' => 'name',
                'label' => 'Priorité'
            ))
            ->add('save', 'submit', array('label' => 'Enregistrer la tâche'));
    }

    public function getName()
    {
        return 'task';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FrontEnd\FrontOfficeBundle\Entity\Task',
        ));
    }
}