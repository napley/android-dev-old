<?php

//

namespace AndroidDev\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * 
 */
class BlogController extends Controller
{

    /**
     * 
     * @return type
     * @throws type
     */
    public function indexAction($page = 1)
    {
        if ($page < 1) {
            throw $this->createNotFoundException('Page inexistante (page =' . $page . ')');
        }
        $render = $this->render('SdzBlogBundle:Blog:index.html.twig');
        return $render;
    }

    /**
     * 
     * @param type $id
     * @return type
     */
    public function voirAction($id)
    {
        // $id vaut 5 si l'on a appelé l'URL /blog/article/5
        // Ici, on récupèrera depuis la base de données l'article correspondant à l'id $id
        // Puis on passera l'article à la vue pour qu'elle puisse l'afficher

        $article = array(
            'id' => 1,
            'titre' => 'Mon weekend a Phi Phi Island !',
            'auteur' => 'winzou',
            'contenu' => 'Ce weekend était trop bien. Blabla…',
            'date' => new \Datetime()
        );

        // Puis modifiez la ligne du render comme ceci, pour prendre en compte l'article :
        $render = $this->render('AndroidDevSiteBundle:Blog:voir.html.twig', array(
            'article' => $article
                )
        );
        return $render;
    }

    /**
     * 
     * @param type $slug
     * @param type $annee
     * @param type $format
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function voirSlugAction($slug, $annee, $format)
    {
        // Ici le contenu de la méthode
        $reponse = new Response("On pourrait afficher l'article correspondant au slug '" . $slug . "', créé en " . $annee . " et au format " . $format . ".");
        return $reponse;
    }

    /**
     * 
     * @param type $nombre
     * @return type
     */
    public function menuAction($nombre)
    { // Ici, nouvel argument $nombre, on a transmis via le with depuis la vue
        // On fixe en dur une liste ici, bien entendu par la suite on la récupérera depuis la BDD !
        // On pourra récupérer $nombre articles depuis la BDD, avec $nombre un paramètre qu'on peut changer lorsqu'on appelle cette action
        $liste = array(
            array('id' => 2, 'titre' => 'Mon dernier weekend !'),
            array('id' => 5, 'titre' => 'Sortie de Symfony2.1'),
            array('id' => 9, 'titre' => 'Petit test')
        );

        $render = $this->render('AndroidDevSiteBundle:Blog:menu.html.twig', array(
            'liste_articles' => $liste // C'est ici tout l'intérêt : le contrôleur passe les variables nécessaires au template !
                )
        );
        return $render;
    }

    /**
     * 
     * @param type $id
     * @return type
     */
    public function modifierAction($id)
    {
        // Ici, on récupérera l'article correspondant à l'$id
        // Ici, on s'occupera de la création et de la gestion du formulaire

        $article = array(
            'id' => 1,
            'titre' => 'Mon weekend a Phi Phi Island !',
            'auteur' => 'winzou',
            'contenu' => 'Ce weekend était trop bien. Blabla…',
            'date' => new \Datetime()
        );

        // Puis modifiez la ligne du render comme ceci, pour prendre en compte l'article :
        $render = $this->render('AndroidDevSiteBundle:Blog:modifier.html.twig', array(
            'article' => $article
                )
        );
        return $render;
    }

}
