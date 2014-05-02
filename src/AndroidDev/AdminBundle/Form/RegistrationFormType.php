<?php

namespace AndroidDev\AdminBundle\Form;

use Symfony\Component\Form\FormBuilderInterface; 
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

class RegistrationFormType extends BaseType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        // Ajoutez vos champs ici, revoilà notre champ *location* :
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('lienProfil')
            ->add('textPresentation')
            ->add('roles');
    }

    public function getName()
    {
        return 'androiddev_user_registration';
    }
}
