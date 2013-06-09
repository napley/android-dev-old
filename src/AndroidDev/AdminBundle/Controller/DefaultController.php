<?php

namespace AndroidDev\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AndroidDevAdminBundle:Default:index.html.twig', array('name' => 'fabien'));
    }
}
