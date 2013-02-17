<?php

namespace AndroidDev\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('sousTitre')
            ->add('contenu')
            ->add('Type')
            ->add('Auteur')
            ->add('Categorie')
            ->add('Projet')
            ->add('MotCles')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AndroidDev\AdminBundle\Entity\Article'
        ));
    }

    public function getName()
    {
        return 'androiddev_adminbundle_articletype';
    }
}
