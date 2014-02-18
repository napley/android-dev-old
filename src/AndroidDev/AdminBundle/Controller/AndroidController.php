<?php

namespace AndroidDev\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AndroidDev\SiteBundle\Entity\Android;
use AndroidDev\AdminBundle\Form\AndroidType;

/**
 * Android controller.
 *
 * @Route("/android")
 */
class AndroidController extends Controller
{
    /**
     * Lists all Android entities.
     *
     * @Route("/", name="admin_android")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AndroidDevSiteBundle:Android')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Android entity.
     *
     * @Route("/{id}/show", name="admin_android_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AndroidDevSiteBundle:Android')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Android entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Android entity.
     *
     * @Route("/new", name="admin_android_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Android();
        $form   = $this->createForm(new AndroidType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new Android entity.
     *
     * @Route("/create", name="admin_android_create")
     * @Method("POST")
     * @Template("AndroidDevAdminBundle:Android:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Android();
        $form = $this->createForm(new AndroidType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_android_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Android entity.
     *
     * @Route("/{id}/edit", name="admin_android_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AndroidDevSiteBundle:Android')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Android entity.');
        }

        $editForm = $this->createForm(new AndroidType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Android entity.
     *
     * @Route("/{id}/update", name="admin_android_update")
     * @Method("POST")
     * @Template("AndroidDevAdminBundle:Android:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AndroidDevSiteBundle:Android')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Android entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new AndroidType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_android_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Android entity.
     *
     * @Route("/{id}/delete", name="admin_android_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AndroidDevSiteBundle:Android')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Android entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_android'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
