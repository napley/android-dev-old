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
        $repository = $this->doctrine->getRepository('AndroidDevSiteBundle:Article');

        // this token is used to authenticate your API request. 
// You can get the token on the API page inside your Piwik interface
        $token_auth = 'bad356cc2019d53e9e09edbadaae9312';

        $firstDay = new \DateTime();
        $today = new \DateTime();
        $firstDay->modify('-7 day');

        $url = "http://www.android-dev.fr/Piwik/index.php?module=API&method=Actions.getPageTitles&idSite=1&period=range&date=".$firstDay->format('Y-m-d').",".$today->format('Y-m-d')."&format=json&filter_limit=15&token_auth=bad356cc2019d53e9e09edbadaae9312";

        $fetched = file_get_contents($url);
        $content = json_decode($fetched);
        foreach ($content as $cle => $article) {
            $content[$cle]->label = str_replace(' | Android-dev.fr', '', html_entity_decode($article->label, ENT_QUOTES));
            $article = $repository->findByNom($content[$cle]->label);
            if ($article == null) {
                unset($content[$cle]);
            } else {
                $content[$cle]->id = $article->getId();
                $content[$cle]->slug = $article->getSlug();
            }
        }


// case error
//        if (!$content) {
//            print("Error, content fetched = " . $fetched);
//        }

        return array(
            'topPiwik' => $content,
        );
    }

    public function getName()
    {
        return 'toppiwik';
    }

}