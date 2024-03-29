<?php

namespace AndroidDev\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CategorieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('vignette', 'text', array(
                    'required' => false,
                    'attr' => array('class' => 'champs-vignette')
                ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AndroidDev\SiteBundle\Entity\Categorie'
        ));
    }

    public function getName()
    {
        return 'androiddev_adminbundle_categorietype';
    }
}
