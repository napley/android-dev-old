<?php

namespace AndroidDev\SiteBundle\Form;

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
            ->add('slug')
            ->add('deletedAt')
            ->add('created')
            ->add('updated')
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
            'data_class' => 'AndroidDev\SiteBundle\Entity\Article'
        ));
    }

    public function getName()
    {
        return 'androiddev_sitebundle_articletype';
    }
}
