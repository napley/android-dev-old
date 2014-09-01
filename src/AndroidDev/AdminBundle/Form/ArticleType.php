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
                ->add('sousTitre', 'textarea', array(
                    'required' => false,
                ))
                ->add('vignette', 'text', array(
                    'required' => false,
                    'attr' => array('class' => 'champs-vignette')
                ))
                ->add('contenu', 'textarea', array(
                    'required' => false,
                ))
                ->add('visible', 'checkbox', array(
                    'required' => false,
                ))
                ->add('type', 'entity', array(
                    'class' => 'AndroidDevSiteBundle:Type',
                    'property' => 'nom',
                ))
                ->add('categorie', 'entity', array(
                    'class' => 'AndroidDevSiteBundle:Categorie',
                    'property' => 'nom',))
                ->add('publishedAt', 'datetime', array(
                        'widget' => 'choice'
                ));
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
