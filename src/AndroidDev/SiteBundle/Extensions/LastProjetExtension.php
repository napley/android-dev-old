<?php

//src/AndroidDev/SiteBundle/Extensions/LastProjetExtension.php

namespace AndroidDev\SiteBundle\Extensions;
use Symfony\Bridge\Doctrine\RegistryInterface;
class LastProjetExtension extends \Twig_Extension
{

    protected $doctrine;

    function __construct(RegistryInterface $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function getGlobals()
    {
        $repository = $this->doctrine->getRepository('AndroidDevSiteBundle:Article');

        $projets = $repository->findProjetByPage(1, 5);
        
        return array(
            'lastProjet' => $projets,
        );
    }

    public function getName()
    {
        return 'lastprojet';
    }

}