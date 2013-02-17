<?php

namespace AndroidDev\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AndroidDev\SiteBundle\Entity\Article;
use AndroidDev\SiteBundle\Form\ArticleType;

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
        $form = $this->createFormBuilder($entity)
                ->add('titre', 'text')
                ->add('sousTitre', 'textarea')
                ->add('contenu', 'textarea')
                ->add('type', 'entity', array(
                    'class' => 'AndroidDevSiteBundle:Type',
                    'property' => 'nom',
                ))
                ->add('categorie', 'entity', array(
                    'class' => 'AndroidDevSiteBundle:Categorie',
                    'property' => 'nom',
                ))
                ->getForm();

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
        $form = $this->createFormBuilder($entity)
                ->add('titre', 'text')
                ->add('sousTitre', 'textarea')
                ->add('contenu', 'textarea')
                ->add('type', 'entity', array(
                    'class' => 'AndroidDevSiteBundle:Type',
                    'property' => 'nom',
                ))
                ->add('categorie', 'entity', array(
                    'class' => 'AndroidDevSiteBundle:Categorie',
                    'property' => 'nom',
                ))
                ->getForm();

        if ($request->isMethod('POST')) {
            $form->bind($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($entity);
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
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AndroidDevSiteBundle:Article')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Article entity.');
        }

        $editForm = $this->createFormBuilder($entity)
                ->add('titre', 'text')
                ->add('sousTitre', 'textarea')
                ->add('contenu', 'textarea')
                ->add('type', 'entity', array(
                    'class' => 'AndroidDevSiteBundle:Type',
                    'property' => 'nom',
                ))
                ->add('categorie', 'entity', array(
                    'class' => 'AndroidDevSiteBundle:Categorie',
                    'property' => 'nom',
                ))
                ->getForm();
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
        $editForm = $this->createFormBuilder($entity)
                ->add('titre', 'text')
                ->add('sousTitre', 'textarea')
                ->add('contenu', 'textarea')
                ->add('type', 'entity', array(
                    'class' => 'AndroidDevSiteBundle:Type',
                    'property' => 'nom',
                ))
                ->add('categorie', 'entity', array(
                    'class' => 'AndroidDevSiteBundle:Categorie',
                    'property' => 'nom',
                ))
                ->getForm();
        if ($request->isMethod('POST')) {
            $editForm->bind($request);

            if ($editForm->isValid()) {
                $em->persist($entity);
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
