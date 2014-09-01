<?php

//src/AndroidDev/SiteBundle/Extensions/LastUpdateExtension.php

namespace AndroidDev\SiteBundle\Extensions;

use Symfony\Bridge\Doctrine\RegistryInterface;

class ProjetPartExtension extends \Twig_Extension
{

    protected $doctrine;
    protected $idProjet;

    function __construct(RegistryInterface $doctrine, $idProjet)
    {
        $this->doctrine = $doctrine;
        $this->idProjet = $idProjet;
    }

    public function getGlobals()
    {
        $projet = $this->doctrine
                ->getEntityManager()
                ->getRepository('AndroidDevSiteBundle:Projet')
                ->find($this->idProjet);
        
        $parts = $this->doctrine
                ->getEntityManager()
                ->getRepository('AndroidDevSiteBundle:Projet')
                ->listPartsByIndex($projet);

        return array(
            'projetPart' => $parts,
        );
    }

    public function getName()
    {
        return 'projetpart';
    }

}
