<?php

namespace AndroidDev\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AndroidDev\SiteBundle\Entity\Article;
use AndroidDev\AdminBundle\Form\ArticleType;

/**
 * Article controller.
 *
 */
class ArticleController extends Controller
{

    /**
     * Lists all Article entities.
     *
     * @Template("AndroidDevAdminBundle:Article:index.html.twig")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AndroidDevSiteBundle:Article')->findAll();


        $articles = $em->getRepository('AndroidDevSiteBundle:Article')->findLastArticleByPage(1, 10);
        $factory = $this->get('nekland_feed.factory');
        $factory->load('my_feed', 'rss_file');
        $feed = $factory->get('my_feed');
        foreach ($articles as $article) {
            $feed->add($article);
        }

        $articles = $em->getRepository('AndroidDevSiteBundle:Article')->findArticleByPage(1, 10);
        $factory2 = $this->get('nekland_feed.factory');
        $factory2->load('my_feed2', 'rss_file');
        $feed2 = $factory->get('my_feed2');
        foreach ($articles as $article) {
            $feed2->add($article);
        }


        $articles = $em->getRepository('AndroidDevSiteBundle:Article')->findAstuceByPage(1, 10);
        $factory3 = $this->get('nekland_feed.factory');
        $factory3->load('my_feed3', 'rss_file');
        $feed3 = $factory->get('my_feed3');
        foreach ($articles as $astuce) {
            $feed3->add($astuce);
        }

        $factory->render('my_feed', 'rss');
        $factory2->render('my_feed2', 'rss');
        $factory3->render('my_feed3', 'rss');

        //Mise à jour des stats
        $repository = $em->getRepository('AndroidDevSiteBundle:Article');
        $repoStat = $em->getRepository('AndroidDevSiteBundle:Stat');

        $stats = $repoStat->SortAllById();

        $content = array();
        foreach ($stats as $stat) {
            $em->remove($stat);
            $em->flush();
        }

        // this token is used to authenticate your API request. 
// You can get the token on the API page inside your Piwik interface
        $token_auth = 'bad356cc2019d53e9e09edbadaae9312';

        $firstDay = new \DateTime();
        $today = new \DateTime();
        $firstDay->modify('-7 day');

        $url = "http://www.android-dev.fr/Piwik/index.php?module=API&method=Actions.getPageTitles&idSite=1&period=range&date=" . $firstDay->format('Y-m-d') . "," . $today->format('Y-m-d') . "&format=json&filter_limit=15&token_auth=" . $token_auth;

        $fetched = file_get_contents($url);
        $content = json_decode($fetched);
        foreach ($content as $cle => $article) {
            $content[$cle]->label = str_replace(' | Android-dev.fr', '', html_entity_decode($article->label, ENT_QUOTES));
            $article = $repository->findByNom($content[$cle]->label);
            if ($article == null) {
                unset($content[$cle]);
            } else {
                $stat = new \AndroidDev\SiteBundle\Entity\Stat();
                $stat->setTitre($article->getTitre());
                $stat->setUrl($article->getSlug());
                
                $em->persist($stat);
                $em->flush();
//                $content[$cle]->id = $article->getId();
//                $content[$cle]->slug = $article->getSlug();
            }
        }

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Article entity.
     *
     * @Template("AndroidDevAdminBundle:Article:show.html.twig")
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AndroidDevSiteBundle:Article')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Article entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Article entity.
     *
     * @Template("AndroidDevAdminBundle:Article:new.html.twig")
     */
    public function newAction()
    {
        $entity = new Article();

        $form = $this->createForm(new ArticleType(), $entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a new Article entity.
     *
     * @Method("POST")
     * @Template("AndroidDevAdminBundle:Article:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Article();
        $form = $this->createForm(new ArticleType(), $entity);

        if ($request->isMethod('POST')) {
            $form->bind($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $entity->setAuteur($em->getRepository('AndroidDevUserBundle:User')->find(1));
                $em->persist($entity);

                foreach ($_POST['motCle'] as $cle => $textMotCle) {
                    $motCle = $em->getRepository('AndroidDevSiteBundle:MotCle')->findByMotCle($textMotCle);
                    if (!empty($motCle)) {
                        $entity->addMotCle($motCle);
                    } else {
                        $motCle = new \AndroidDev\SiteBundle\Entity\MotCle($textMotCle);
                        $entity->addMotCle($motCle);
                    }
                }

                $em->flush();

                return $this->redirect($this->generateUrl('admin_article_show', array('id' => $entity->getId())));
            }
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Article entity.
     *
     * @Template("AndroidDevAdminBundle:Article:edit.html.twig")
     */
    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AndroidDevSiteBundle:Article')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Article entity.');
        }

        foreach ($entity->getMotCles() as $motcle) {
            $originalMotCles[] = $motcle;
        }

        $editForm = $this->createForm(new ArticleType(), $entity);

        if ($request->isMethod('POST')) {
            $editForm->bind($this->getRequest());

            if ($editForm->isValid()) {

                // filter $originalTags to contain tags no longer present
                foreach ($entity->getMotCles() as $motcle) {
                    foreach ($originalMotCles as $key => $toDel) {
                        if ($toDel->getId() === $motcle->getId()) {
                            unset($originalMotCles[$key]);
                        }
                    }
                }

                // remove the relationship between the tag and the Task
                foreach ($originalMotCles as $motcle) {
                    // remove the Task from the Tag
                    $motcle->getMotCles()->removeElement($entity);

                    // if it were a ManyToOne relationship, remove the relationship like this
                    // $tag->setTask(null);

                    $em->persist($motcle);

                    // if you wanted to delete the Tag entirely, you can also do that
                    // $em->remove($tag);
                }

                $em->persist($entity);
                $em->flush();

                // redirect back to some edit page
                return $this->redirect($this->generateUrl('admin_article_edit', array('id' => $id)));
            }
        }



        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Article entity.
     *
     * @Template("AndroidDevSiteBundle:Article:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AndroidDevSiteBundle:Article')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Article entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new ArticleType(), $entity);
        if ($request->isMethod('POST')) {
            $editForm->bind($request);

            if ($editForm->isValid()) {
                $em->persist($entity);

                foreach ($entity->getMotCles() as $motCle) {
                    $trouve = false;
                    foreach ($_POST['motCle'] as $cle => $textMotCle) {
                        if ($textMotCle == $motCle->getNom()) {
                            $trouve = true;
                        }
                    }
                    if ($trouve == false) {
                        $entity->removeMotcle($motCle);
                    }
                }

                if (!empty($_POST['motCle'])) {
                    foreach ($_POST['motCle'] as $cle => $textMotCle) {
                        $motCleEnt = $em->getRepository('AndroidDevSiteBundle:MotCle')->findByMotCle($textMotCle);
                        if (!empty($motCleEnt)) {
                            $entity->addMotCle($motCleEnt);
                        } else {
                            $motCleEnt = new \AndroidDev\SiteBundle\Entity\MotCle($textMotCle);
                            $entity->addMotCle($motCleEnt);
                        }
                    }
                }

                $em->flush();

                return $this->redirect($this->generateUrl('admin_article_edit', array('id' => $id)));
            }
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Article entity.
     *
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AndroidDevSiteBundle:Article')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Article entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_article'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

}
