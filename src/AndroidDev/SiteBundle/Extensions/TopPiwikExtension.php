<?php

//src/AndroidDev/SiteBundle/Service/TopPiwik.php

namespace AndroidDev\SiteBundle\Extensions;

use Symfony\Bridge\Doctrine\RegistryInterface;

class TopPiwikExtension extends \Twig_Extension
{

    function __construct()
    {
        
    }

    public function getGlobals()
    {
        // this token is used to authenticate your API request. 
// You can get the token on the API page inside your Piwik interface
        $token_auth = 'bad356cc2019d53e9e09edbadaae9312';

// we call the REST API and request the 100 first keywords for the last month for the idsite=1
        $url = "http://android-dev.fr/Piwik/";
        $url .= "?module=API&method=Actions.getPageTitles";
        $url .= "&idSite=1&period=range&date=2013-03-5,2013-03-12";
        $url .= "&format=php&filter_limit=10";
        $url .= "&token_auth=$token_auth";

        $fetched = file_get_contents($url);
        $content = unserialize($fetched);

        foreach ($content as $cle => $article) {
            $content[$cle]['label'] = html_entity_decode($article['label'], ENT_QUOTES);
        }


// case error
        if (!$content) {
            print("Error, content fetched = " . $fetched);
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