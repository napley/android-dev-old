<?php

//

namespace AndroidDev\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

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
    public function contactAction()
    {
        $form = $this->createFormBuilder()
                ->add('nom', 'text')
                ->add('prenom', 'text')
                ->add('mail', 'email')
                ->add('objet', 'text')
                ->add('contenu', 'textarea')
                ->getForm();

        $render = $this->render('AndroidDevSiteBundle:Blog:contact.html.twig', array(
            'form' => $form->createView(),'error' => false 
        ));
        return $render;
    }

    /**
     * 
     * @return type
     * @throws type
     */
    public function aproposAction()
    {

        $render = $this->render('AndroidDevSiteBundle:Blog:apropos.html.twig');
        return $render;
    }

    /**
     * 
     * @return type
     * @throws type
     */
    public function mentionsAction()
    {

        $render = $this->render('AndroidDevSiteBundle:Blog:mentions.html.twig');
        return $render;
    }
    
    /**
     * 
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return type
     */
    public function sendcontactAction(Request $request)
    {
        $form = $this->createFormBuilder()
                ->add('nom', 'text')
                ->add('prenom', 'text')
                ->add('mail', 'email')
                ->add('objet', 'text')
                ->add('contenu', 'textarea')
                ->getForm();

        if ($request->isMethod('POST')) {
            $form->bind($request);

            // les données sont un tableau avec les clés "name", "email", et "message"
            $data = $form->getData();
        }

        $message = \Swift_Message::newInstance();
        $message->setSubject($data['objet']);
        $message->setFrom($data['mail']);
        $message->setTo('postmaster@android-dev.fr');
        $message->setBody($this->renderView('AndroidDevSiteBundle:Blog:email.html.twig', array('data' => $data)));
        $message->setContentType("text/html");
        $send = $this->get('mailer')->send($message);

        if ($send) {
            $render = $this->render('AndroidDevSiteBundle:Blog:contactok.html.twig', array(
                'form' => $form->createView(),
            ));
        } else {

            $render = $this->render('AndroidDevSiteBundle:Blog:contact.html.twig', array(
                'form' => $form->createView(), 'error' => true, 'data' => $data
            ));
        }
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


        if (!empty($article)) {
            $category = $article->getCategorie();
            if (!empty($category)) {
                $links = $this->getDoctrine()
                        ->getEntityManager()
                        ->getRepository('AndroidDevSiteBundle:Article')
                        ->findLink($article->getId(), $category->getSlug(), 5);
            } else {
                $links = null;
            }
        }

        if (empty($article)) {
            return $this->redirect($this->generateUrl('androiddev_accueil'), 301);
        }

        $render = $this->render('AndroidDevSiteBundle:Blog:voir.html.twig', array(
            'article' => $article, 'links' => $links
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

    public function redirectAction($id, $titre = null)
    {
        $article = $this->getDoctrine()
                ->getEntityManager()
                ->getRepository('AndroidDevSiteBundle:Article')
                ->findById($id);

        if (empty($article)) {
            return $this->redirect($this->generateUrl('androiddev_accueil'), 301);
        }

        return $this->redirect($this->generateUrl('androiddev_voir', array('slug' => $article->getSlug())), 301);
    }

    public function redirectAccueilAction()
    {
        return $this->redirect($this->generateUrl('androiddev_accueil'), 301);
    }

    public function redirectProjetAction()
    {
        return $this->redirect($this->generateUrl('androiddev_projet'), 301);
    }

    public function redirectArticleAction()
    {
        return $this->redirect($this->generateUrl('androiddev_article'), 301);
    }

    public function getJsonAction()
    {
        $articles = $this->getDoctrine()
                ->getEntityManager()
                ->getRepository('AndroidDevSiteBundle:Article')
                ->findLastArticleByPage(1, 40);

        $data = array();
        $index = 0;
        foreach ($articles as $article) {
            $data['article'][$index]['id'] = $article->getId();
            $data['article'][$index]['titre'] = $article->getTitre();
            $data['article'][$index]['sstitre'] = $article->getSousTitre();
            $data['article'][$index]['contenu'] = $article->getContenu();
            $data['article'][$index]['created'] = $article->getCreated()->format('Y-m-d H:i:s');
            $data['article'][$index]['categorie'] = $article->getCategorie()->getId();
            $data['article'][$index]['type'] = $article->getType()->getId();
            $index++;
        }

        return new JsonResponse($data);
    }

}
