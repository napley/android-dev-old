<?php

namespace AndroidDev\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PointType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pct')
            ->add('date')
            ->add('Android')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AndroidDev\SiteBundle\Entity\Point'
        ));
    }

    public function getName()
    {
        return 'androiddev_adminbundle_pointtype';
    }
}
