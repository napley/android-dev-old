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

        $articles = $repository->SortAllById();

        $index = 0;
        $content = array();
        foreach ($articles as $article) {
            $content[$index]['id'] = $article->getId();
            $content[$index]['slug'] = $article->getUrl();
            $content[$index]['label'] = $article->getTitre();
            $index++;
        }

        return array(
            'topPiwik' => $content,
        );
    }

    public function getName()
    {
        return 'toppiwik';
    }

}