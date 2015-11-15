<?php

//src/AndroidDev/SiteBundle/Extensions/TopArticleExtension.php

namespace AndroidDev\SiteBundle\Extensions;
use Symfony\Bridge\Doctrine\RegistryInterface;

class TopArticleExtension extends \Twig_Extension
{

    protected $doctrine;

    function __construct(RegistryInterface $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function getGlobals()
    {
        $repository = $this->doctrine->getRepository('AndroidDevSiteBundle:Article');

        $article = $repository->findByTop();
        
        return array(
            'topArticle' => $article,
        );
    }

    public function getName()
    {
        return 'toparticle';
    }

}