<?php

//src/AndroidDev/SiteBundle/Service/InfoSite.php

namespace AndroidDev\AdminBundle\Service;

use Symfony\Bridge\Doctrine\RegistryInterface;

class Article
{

    protected $doctrine;

    function __construct(RegistryInterface $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function getArticle($id)
    {
        $repository = $this->doctrine->getRepository('AndroidDevSiteBundle:Article');

        $article = $repository->find($id);
        
        return $article;
    }

}