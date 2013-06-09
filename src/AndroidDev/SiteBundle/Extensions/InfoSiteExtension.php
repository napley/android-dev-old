<?php

//src/AndroidDev/SiteBundle/Extensions/InfoSiteExtension.php

namespace AndroidDev\SiteBundle\Extensions;
use Symfony\Bridge\Doctrine\RegistryInterface;
class InfoSiteExtension extends \Twig_Extension
{

    protected $doctrine;

    function __construct(RegistryInterface $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function getGlobals()
    {
        $repository = $this->doctrine->getRepository('AndroidDevSiteBundle:InfoSite');

        $info = $repository->findByArray(1);
        
        return array(
            'infosite' => $info[0],
        );
    }

    public function getName()
    {
        return 'infosite';
    }

}