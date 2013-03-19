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
        $page = (($page < 1 || empty($page)) ? 1 : $page);

        $infoSite = $this->container->get('androiddev.infosite')->getInfoSite();

        $liste_articles = $this->getDoctrine()
                ->getEntityManager()
                ->getRepository('AndroidDevSiteBundle:Article')
                ->findLastArticleByPage($page, $infoSite['nbByPage']);

        $routeBef['page'] = $page - 1;
        $routeAft['page'] = $page + 1;

        $render = $this->render('AndroidDevSiteBundle:Blog:index.html.twig', array(
            'articles' => $liste_articles, 'page' => $page, 'routeBef' => $routeBef, 'routeAft' => $routeAft, 'route' => 'androiddev_accueil'
        ));
        return $render;
    }

    /**
     * 
     * @return type
     * @throws type
     */
    public function articleAction($page = 1)
    {
        $page = (($page < 1 || empty($page)) ? 1 : $page);

        $infoSite = $this->container->get('androiddev.infosite')->getInfoSite();

        $liste_articles = $this->getDoctrine()
                ->getEntityManager()
                ->getRepository('AndroidDevSiteBundle:Article')
                ->findArticleByPage($page, $infoSite['nbByPage']);

        $routeBef['page'] = $page - 1;
        $routeAft['page'] = $page + 1;

        $render = $this->render('AndroidDevSiteBundle:Blog:index.html.twig', array(
            'articles' => $liste_articles, 'page' => $page, 'routeBef' => $routeBef, 'routeAft' => $routeAft, 'route' => 'androiddev_article', 'type' => 'article'
        ));
        return $render;
    }

    /**
     * 
     * @return type
     * @throws type
     */
    public function articleCatAction($slug, $page = 1)
    {
        $page = (($page < 1 || empty($page)) ? 1 : $page);

        $infoSite = $this->container->get('androiddev.infosite')->getInfoSite();

        $liste_articles = $this->getDoctrine()
                ->getEntityManager()
                ->getRepository('AndroidDevSiteBundle:Article')
                ->findArticleCatByPage($slug, $page, $infoSite['nbByPage']);

        $categorie = $this->getDoctrine()
                ->getEntityManager()
                ->getRepository('AndroidDevSiteBundle:Categorie')
                ->findOneBySlug($slug);

        $routeBef['slug'] = $slug;
        $routeBef['page'] = $page - 1;
        $routeAft['slug'] = $slug;
        $routeAft['page'] = $page + 1;

        $render = $this->render('AndroidDevSiteBundle:Blog:index.html.twig', array(
            'articles' => $liste_articles, 'page' => $page, 'route' => 'androiddev_articleCat', 'routeBef' => $routeBef, 'routeAft' => $routeAft, 'type' => 'article', 'categorie' => $categorie->getNom()
        ));
        return $render;
    }

    /**
     * 
     * @return type
     * @throws type
     */
    public function astuceAction($page = 1)
    {
        $page = (($page < 1 || empty($page)) ? 1 : $page);

        $infoSite = $this->container->get('androiddev.infosite')->getInfoSite();

        $liste_articles = $this->getDoctrine()
                ->getEntityManager()
                ->getRepository('AndroidDevSiteBundle:Article')
                ->findAstuceByPage($page, $infoSite['nbByPage']);

        $routeBef['page'] = $page - 1;
        $routeAft['page'] = $page + 1;

        $render = $this->render('AndroidDevSiteBundle:Blog:index.html.twig', array(
            'articles' => $liste_articles, 'page' => $page, 'routeBef' => $routeBef, 'routeAft' => $routeAft, 'route' => 'androiddev_astuce', 'type' => 'astuce'
        ));
        return $render;
    }

    /**
     * 
     * @return type
     * @throws type
     */
    public function astuceCatAction($slug, $page = 1)
    {
        $page = (($page < 1 || empty($page)) ? 1 : $page);

        $infoSite = $this->container->get('androiddev.infosite')->getInfoSite();

        $liste_articles = $this->getDoctrine()
                ->getEntityManager()
                ->getRepository('AndroidDevSiteBundle:Article')
                ->findAstuceCatByPage($slug, $page, $infoSite['nbByPage']);

        $categorie = $this->getDoctrine()
                ->getEntityManager()
                ->getRepository('AndroidDevSiteBundle:Categorie')
                ->findOneBySlug($slug);

        $routeBef['slug'] = $slug;
        $routeBef['page'] = $page - 1;
        $routeAft['slug'] = $slug;
        $routeAft['page'] = $page + 1;

        $render = $this->render('AndroidDevSiteBundle:Blog:index.html.twig', array(
            'articles' => $liste_articles, 'page' => $page, 'routeBef' => $routeBef, 'routeAft' => $routeAft, 'route' => 'androiddev_astuceCat', 'type' => 'astuce', 'categorie' => $categorie->getNom()
        ));
        return $render;
    }

    /**
     * 
     * @return type
     * @throws type
     */
    public function projetAction($page = 1)
    {
        $page = (($page < 1 || empty($page)) ? 1 : $page);

        $infoSite = $this->container->get('androiddev.infosite')->getInfoSite();

        $liste_articles = $this->getDoctrine()
                ->getEntityManager()
                ->getRepository('AndroidDevSiteBundle:Article')
                ->findProjetByPage($page, $infoSite['nbByPage']);

        $render = $this->render('AndroidDevSiteBundle:Blog:allProjet.html.twig', array(
            'articles' => $liste_articles, 'page' => $page, 'route' => 'androiddev_projet'
        ));
        return $render;
    }

    /**
     * 
     * @param type $id
     * @return type
     */
    public function voirAction($slug)
    {
        $article = $this->getDoctrine()
                ->getEntityManager()
                ->getRepository('AndroidDevSiteBundle:Article')
                ->findBySlug($slug);

        $render = $this->render('AndroidDevSiteBundle:Blog:voir.html.twig', array(
            'article' => $article
                )
        );
        return $render;
    }

    /**
     * 
     * @param type $slug
     * @return type
     */
    public function projetVoirAction($slug)
    {
        $parts = array();
        $projet = $this->getDoctrine()
                ->getEntityManager()
                ->getRepository('AndroidDevSiteBundle:Projet')
                ->findOneBySlug($slug);

        $parts = $this->getDoctrine()
                ->getEntityManager()
                ->getRepository('AndroidDevSiteBundle:Projet')
                ->listPartsByIndex($projet);

        $render = $this->render('AndroidDevSiteBundle:Blog:projet.html.twig', array(
            'projet' => $projet, 'parts' => $parts
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

    /**
     * 
     * @param type $id
     * @return type
     */
    public function createAction()
    {

        // Pour récupérer le service UserManager du bundle
        $userManager = $this->get('fos_user.user_manager');

// Pour charger un utilisateur
        $user = $userManager->findUserBy(array('username' => 'androiddev'));

// Pour modifier un utilisateur
        $user->setPassword('test');
        $userManager->updateUser($user); // Pas besoin de faire un flush avec l'entityManager, cette méthode le fait toute seule !
    }

    /**
     * 
     * @return type
     * @throws type
     */
    public function searchAction()
    {
//        $motCle = array();
//        $motCle = explode(' ', $_POST['motCles']);
//        $articles = $this->getDoctrine()
//                ->getEntityManager()
//                ->getRepository('AndroidDevSiteBundle:Article')
//                ->getArticleBySearch($motCle);

        return $this->redirect($this->generateUrl('androiddev_recherche', array('motcles' => str_replace(' ', '+', $_POST['motCles']))));
    }

    /**
     * 
     * @return type
     * @throws type
     */
    public function rechercheAction($motcles, $page = 1)
    {
        $page = (($page < 1 || empty($page)) ? 1 : $page);

        $infoSite = $this->container->get('androiddev.infosite')->getInfoSite();

        $motCle = array();
        $motCle = explode(' ', str_replace('+', ' ', $motcles));

        $articles = $this->getDoctrine()
                ->getEntityManager()
                ->getRepository('AndroidDevSiteBundle:Article')
                ->getArticleBySearch($motCle, $page, $infoSite['nbByPage']);

        $routeBef['motcles'] = $motcles;
        $routeBef['page'] = $page - 1;
        $routeAft['motcles'] = $motcles;
        $routeAft['page'] = $page + 1;
        
        $motCleJoin = implode(' - ', $motCle);
        
        $render = $this->render('AndroidDevSiteBundle:Blog:index.html.twig', array(
            'articles' => $articles, 'page' => $page, 'routeBef' => $routeBef, 'routeAft' => $routeAft, 'route' => 'androiddev_recherche', 'type' => 'recherche', 'motCle' => $motCleJoin
        ));
        return $render;
    }

}
