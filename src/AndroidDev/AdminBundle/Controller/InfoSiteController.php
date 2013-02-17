<?php

namespace AndroidDev\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AndroidDev\SiteBundle\Entity\InfoSite;
use AndroidDev\AdminBundle\Form\InfoSiteType;

/**
 * InfoSite controller.
 *
 */
class InfoSiteController extends Controller
{
    /**
     * Lists all InfoSite entities.
     *
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AndroidDevSiteBundle:InfoSite')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a InfoSite entity.
     *
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AndroidDevSiteBundle:InfoSite')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find InfoSite entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new InfoSite entity.
     *
     * @Template()
     */
    public function newAction()
    {
        $entity = new InfoSite();
        $form   = $this->createForm(new InfoSiteType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new InfoSite entity.
     *
     * @Method("POST")
     * @Template("AndroidDevSiteBundle:InfoSite:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new InfoSite();
        $form = $this->createForm(new InfoSiteType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_infosite_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing InfoSite entity.
     *
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AndroidDevSiteBundle:InfoSite')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find InfoSite entity.');
        }

        $editForm = $this->createForm(new InfoSiteType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing InfoSite entity.
     *
     * @Method("POST")
     * @Template("AndroidDevSiteBundle:InfoSite:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AndroidDevSiteBundle:InfoSite')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find InfoSite entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new InfoSiteType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_infosite_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a InfoSite entity.
     *
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AndroidDevSiteBundle:InfoSite')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find InfoSite entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_infosite'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
