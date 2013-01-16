<?php

namespace AndroidDev\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class BlogController extends Controller {

    public function indexAction($name) {
        return $this->render('AndroidDevSiteBundle:Default:index.html.twig', array('nom' => $name));
    }

}
