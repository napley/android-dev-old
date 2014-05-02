<?php

namespace AndroidDev\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AndroidDev\SiteBundle\Entity\Point;
use AndroidDev\AdminBundle\Form\PointType;

/**
 * Point controller.
 *
 * @Route("/point")
 */
class PointController extends Controller
{
    /**
     * Lists all Point entities.
     *
     * @Route("/", name="admin_point")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AndroidDevSiteBundle:Point')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Point entity.
     *
     * @Route("/{id}/show", name="admin_point_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AndroidDevSiteBundle:Point')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Point entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Point entity.
     *
     * @Route("/new", name="admin_point_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Point();
        $form   = $this->createForm(new PointType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new Point entity.
     *
     * @Route("/create", name="admin_point_create")
     * @Method("POST")
     * @Template("AndroidDevAdminBundle:Point:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Point();
        $form = $this->createForm(new PointType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_point_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Point entity.
     *
     * @Route("/{id}/edit", name="admin_point_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AndroidDevSiteBundle:Point')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Point entity.');
        }

        $editForm = $this->createForm(new PointType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Point entity.
     *
     * @Route("/{id}/update", name="admin_point_update")
     * @Method("POST")
     * @Template("AndroidDevAdminBundle:Point:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AndroidDevSiteBundle:Point')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Point entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new PointType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_point_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Point entity.
     *
     * @Route("/{id}/delete", name="admin_point_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AndroidDevSiteBundle:Point')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Point entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_point'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
