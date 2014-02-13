<?php

namespace AndroidDev\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AndroidDev\SiteBundle\Entity\Projet;
use AndroidDev\AdminBundle\Form\ProjetType;

/**
 * Projet controller.
 *
 */
class ProjetController extends Controller
{

    /**
     * Lists all Projet entities.
     *
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AndroidDevSiteBundle:Projet')->findAll();
//
//        $projets = $em->getRepository('AndroidDevSiteBundle:Projet')->findLastNotEmpty(10);
//        $factory = $this->get('nekland_feed.factory');
//        $factory->load('my_feed4', 'rss_file'); 
//        $feed = $factory->get('my_feed4');
//        foreach ($projets as $projet) {
//            $feed->add($projet);
//        }
//        
//        $factory->render('my_feed4', 'rss');
        
        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Projet entity.
     *
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AndroidDevSiteBundle:Projet')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Projet entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Projet entity.
     *
     * @Template()
     */
    public function newAction()
    {
        $entity = new Projet();
        $form = $this->createForm(new ProjetType(), $entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a new Projet entity.
     *
     * @Method("POST")
     * @Template("AndroidDevSiteBundle:Projet:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Projet();
        $form = $this->createForm(new ProjetType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);

            foreach ($_POST['partProject']['id'] as $cle => $idPartProject) {
                $article = $this->container->get('androiddev.article')->getArticle($idPartProject);
                $PartProject = new \AndroidDev\SiteBundle\Entity\ArticleProjet($entity, $article, $_POST['partProject']['index'][$cle]);
                $em->persist($PartProject);
            }
            $em->flush();

            return $this->redirect($this->generateUrl('admin_projet_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Projet entity.
     *
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AndroidDevSiteBundle:Projet')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Projet entity.');
        }

        $editForm = $this->createForm(new ProjetType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Projet entity.
     *
     * @Method("POST")
     * @Template("AndroidDevSiteBundle:Projet:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AndroidDevSiteBundle:Projet')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Projet entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new ProjetType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);

            foreach ($entity->getArticles() as $part) {
                $trouve = false;
                foreach ($_POST['partProject']['id'] as $cle => $idPartProject) {
                    if ($idPartProject == $part->getArticle()->getId()) {
                        $trouve = true;
                    }
                }
                if ($trouve == false) {
                    $em->remove($part);
                }
            }

            foreach ($_POST['partProject']['id'] as $cle => $idPartProject) {
                $article = $this->container->get('androiddev.article')->getArticle($idPartProject);
                $part = $em->getRepository('AndroidDevSiteBundle:ArticleProjet')->findPartByProjetAndArticle($entity, $article);
                if (!empty($part)) {
                    $part->setRang($_POST['partProject']['index'][$cle]);
                } else {
                    $PartProject = new \AndroidDev\SiteBundle\Entity\ArticleProjet($entity, $article, $_POST['partProject']['index'][$cle]);
                    $em->persist($PartProject);
                }
            }

            $em->flush();

            return $this->redirect($this->generateUrl('admin_projet_edit', array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Projet entity.
     *
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AndroidDevSiteBundle:Projet')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Projet entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_projet'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

}
