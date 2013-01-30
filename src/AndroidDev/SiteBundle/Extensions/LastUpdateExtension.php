<?php

//src/AndroidDev/SiteBundle/Extensions/LastUpdateExtension.php

namespace AndroidDev\SiteBundle\Extensions;
use Symfony\Bridge\Doctrine\RegistryInterface;
class LastUpdateExtension extends \Twig_Extension
{

    protected $doctrine;

    function __construct(RegistryInterface $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function getGlobals()
    {
        $repository = $this->doctrine->getRepository('AndroidDevSiteBundle:Article');

        $articles = $repository->findLastUpdateArticle(8);
        
        return array(
            'lastUpdate' => $articles,
        );
    }

    public function getName()
    {
        return 'lastupdate';
    }

}