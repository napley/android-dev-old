<?php

//src/AndroidDev/SiteBundle/Extensions/LastUpdateExtension.php

namespace AndroidDev\AdminBundle\Extensions;
use Symfony\Bridge\Doctrine\RegistryInterface;

class PartProjectExtension extends \Twig_Extension
{

    protected $doctrine;

    function __construct(RegistryInterface $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function getGlobals()
    {
        $repository = $this->doctrine->getRepository('AndroidDevSiteBundle:Article');

        $articles = $repository->findAllPartProject();
        
        return array(
            'partProject' => $articles,
        );
    }

    public function getName()
    {
        return 'partproject';
    }

}