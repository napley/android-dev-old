<?php
// src/Acme/Sample/StoreBundle/Controller/SitemapsController.php
namespace AndroidDev\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class SitemapController extends Controller
{

    /**
     * @Template("AndroidDevSiteBundle:Sitemap:sitemap.xml.twig")
     */
    public function sitemapAction() 
    {
        $em = $this->getDoctrine()->getEntityManager();
        
        $urls = array();
        $hostname = $this->getRequest()->getHost();

        // add some urls homepage
        $urls[] = array('loc' => $this->generateUrl('androiddev_accueil'), 'changefreq' => 'weekly', 'priority' => '1.0');

        // multi-lang pages
//        foreach($languages as $lang) {
//            $urls[] = array('loc' => $this->get('router')->generate('home_contact', array('_locale' => $lang)), 'changefreq' => 'monthly', 'priority' => '0.3');
//        }
        
        // urls from database
//        $urls[] = array('loc' => $this->get('router')->generate('home_product_overview', array('_locale' => 'en')), 'changefreq' => 'weekly', 'priority' => '0.7');
        // service
        foreach ($em->getRepository('AndroidDevSiteBundle:Article')->findAll() as $article) {
            $urls[] = array('loc' => $this->generateUrl('androiddev_voir', 
                    array('slug' => $article->getSlug())), 'priority' => '0.5');
        }
        
        foreach ($em->getRepository('AndroidDevSiteBundle:Projet')->findAll() as $projet) {
            $urls[] = array('loc' => $this->generateUrl('androiddev_projetVoir', 
                    array('slug' => $projet->getSlug())), 'priority' => '0.5');
        }
        

        return array('urls' => $urls, 'hostname' => $hostname);
    }
}