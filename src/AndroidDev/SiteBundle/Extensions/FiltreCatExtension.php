<?php

namespace AndroidDev\SiteBundle\Extensions;
use Symfony\Bridge\Doctrine\RegistryInterface;

class FiltreCatExtension extends \Twig_Extension
{

    protected $doctrine;

    function __construct(RegistryInterface $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function getGlobals()
    {
        $filtre = array();
        
        $repository = $this->doctrine->getRepository('AndroidDevSiteBundle:Type');
        $filtre['article'] = $repository->findCat(1);
        
        $repository = $this->doctrine->getRepository('AndroidDevSiteBundle:Projet');
        $filtre['projet'] = $repository->findNotEmpty();
        
        $repository = $this->doctrine->getRepository('AndroidDevSiteBundle:Type');
        $filtre['astuce'] = $repository->findCat(2);
        
        return array(
            'filtrecat' => $filtre,
        );
    }

    public function getName()
    {
        return 'filtrecat';
    }

}