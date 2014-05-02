<?php

//src/AndroidDev/SiteBundle/Extensions/LastUpdateExtension.php

namespace AndroidDev\SiteBundle\Extensions;

use Symfony\Bridge\Doctrine\RegistryInterface;

class ArticleCatExtension extends \Twig_Extension
{

    protected $doctrine;

    function __construct(RegistryInterface $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function getGlobals($id = 10, $nb = 5)
    {
        $repository = $this->doctrine->getRepository('AndroidDevSiteBundle:Article');

        $articles = $repository->findArticleCatByIdCat($id, $nb);

        return array(
            'articleCat' => $articles,
        );
    }

    public function getName()
    {
        return 'articlecat';
    }

}
