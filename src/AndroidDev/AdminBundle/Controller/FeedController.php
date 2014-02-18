<?php

// src/Acme/Sample/StoreBundle/Controller/SitemapsController.php

namespace AndroidDev\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FeedController extends Controller
{

    /**
     * Generate the article feed
     *
     * 
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function articleAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $articles = $em->getRepository('AndroidDevSiteBundle:Article')->findArticleByPage(1, 1000);

        $feed = $this->get('eko_feed.feed.manager')->get('my_feed2');
        $feed->addFromArray($articles);

        return new Response($feed->render('rss')); // or 'atom'
    }

    /**
     * Generate the article feed
     *
     * 
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function astuceAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $articles = $em->getRepository('AndroidDevSiteBundle:Article')->findAstuceByPage(1, 1000);

        $feed = $this->get('eko_feed.feed.manager')->get('my_feed3');
        $feed->addFromArray($articles);

        return new Response($feed->render('rss')); // or 'atom'
    }

    /**
     * Generate the article feed
     *
     * 
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function articleAstuceAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $articles = $em->getRepository('AndroidDevSiteBundle:Article')->findLastArticleByPage(1, 1000);

        $feed = $this->get('eko_feed.feed.manager')->get('my_feed');
        $feed->addFromArray($articles);

        return new Response($feed->render('rss')); // or 'atom'
    }

    /**
     * Generate the article feed
     *
     * 
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function projetAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $projets = $em->getRepository('AndroidDevSiteBundle:Projet')->findLastNotEmpty(1000);

        $feed = $this->get('eko_feed.feed.manager')->get('my_feed4');
        $feed->addFromArray($projets);

        return new Response($feed->render('rss')); // or 'atom'
    }

}
