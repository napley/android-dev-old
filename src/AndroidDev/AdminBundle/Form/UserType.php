<?php

namespace AndroidDev\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username')
            ->add('email')
            ->add('roles')
            ->add('nom')
            ->add('prenom')
            ->add('lienProfil')
            ->add('textPresentation')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AndroidDev\UserBundle\Entity\User'
        ));
    }

    public function getName()
    {
        return 'androiddev_adminbundle_usertype';
    }
}
