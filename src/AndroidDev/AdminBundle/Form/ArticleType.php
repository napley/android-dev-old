<?php

namespace AndroidDev\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ArticleType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('titre', 'text')
                ->add('sousTitre', 'textarea')
                ->add('contenu', 'textarea')
                ->add('type', 'entity', array(
                    'class' => 'AndroidDevSiteBundle:Type',
                    'property' => 'nom',
                ))
                ->add('categorie', 'entity', array(
                    'class' => 'AndroidDevSiteBundle:Categorie',
                    'property' => 'nom',));
        $builder->add('motcles', 'collection', array('type' => new MotClesType(),
            'allow_add' => true,
            'allow_delete' => true,
            'by_reference' => false,))
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
        return 'androiddev_adminbundle_articletype';
    }

}
