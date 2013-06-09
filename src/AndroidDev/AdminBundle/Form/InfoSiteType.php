<?php

namespace AndroidDev\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class InfoSiteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('description')
            ->add('entete')
            ->add('footer')
            ->add('aPropos')
            ->add('codeSocial')
            ->add('codeAnalytics')
            ->add('nbByPage')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AndroidDev\SiteBundle\Entity\InfoSite'
        ));
    }

    public function getName()
    {
        return 'androiddev_adminbundle_infositetype';
    }
}
