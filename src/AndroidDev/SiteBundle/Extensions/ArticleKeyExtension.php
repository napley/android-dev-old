<?php

//src/AndroidDev/SiteBundle/Extensions/LastUpdateExtension.php

namespace AndroidDev\SiteBundle\Extensions;

use Symfony\Bridge\Doctrine\RegistryInterface;

class ArticleKeyExtension extends \Twig_Extension
{

    protected $doctrine;

    function __construct(RegistryInterface $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function getFunctions()
    {
        return array(
            'articleKey' => new \Twig_Function_Method($this, 'getArticleCatByIdKey'),
        );
    }

    public function getArticleCatByIdKey($id = 64, $nb = 5)
    {
        $repository = $this->doctrine->getRepository('AndroidDevSiteBundle:Article');

        $articles = $repository->findArticleCatByIdKey($id, $nb);

        return $articles;
    }

    public function getName()
    {
        return 'articlekey';
    }

}
