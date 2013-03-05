<?php

namespace AndroidDev\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProjetType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('titre')
                ->add('sousTitre', 'checkbox', array(
                    'required' => false,
                ))
                ->add('contenu', 'checkbox', array(
                    'required' => false,
                ))
                ->add('contenuFin', 'checkbox', array(
                    'required' => false,
                ))
                ->add('visible', 'checkbox', array(
                    'required' => false,
                ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AndroidDev\SiteBundle\Entity\Projet'
        ));
    }

    public function getName()
    {
        return 'androiddev_adminbundle_projettype';
    }

}
