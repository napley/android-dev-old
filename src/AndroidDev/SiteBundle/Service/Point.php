<?php

//src/AndroidDev/SiteBundle/Service/Point.php

namespace AndroidDev\SiteBundle\Service;

use Symfony\Bridge\Doctrine\RegistryInterface;

class Point
{

    protected $doctrine;

    function __construct(RegistryInterface $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function getPoint($version, $date)
    {
//        $repository = $this->doctrine->getRepository('AndroidDevSiteBundle:Point');
//
//        $info = $repository->findByArray(1);
//        
//        return $info[0];

        $Point = $this->doctrine
                ->getRepository('AndroidDevSiteBundle:Android')
                ->findPoint($version, $date);


        if (!empty($Point)) {
            return $Point->getPct();
        } else {
            return 0;
        }
    }

}
