<?php

//src/AndroidDev/SiteBundle/Service/TopPiwik.php

namespace AndroidDev\SiteBundle\Extensions;

use Symfony\Bridge\Doctrine\RegistryInterface;

class TopPiwikExtension extends \Twig_Extension
{

    protected $doctrine;

    function __construct(RegistryInterface $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function getGlobals()
    {
        $repository = $this->doctrine->getRepository('AndroidDevSiteBundle:Stat');

        $stats = $repository->SortAllByRank();

        return array(
            'topPiwik' => $stats,
        );
    }

    public function getName()
    {
        return 'toppiwik';
    }

}