<?php

namespace LPDW\TrainspovingBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use LPDW\TrainspovingBundle\Entity\Reminder;
use LPDW\TrainspovingBundle\Form\ReminderType;

/**
 * Reminder controller.
 *
 * @Route("/home")
 */
class ReminderController extends Controller
{
    /**
     * Lists all Reminder entities.
     *
     * @Route("/", name="reminder")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('LPDWTrainspovingBundle:Reminder')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Reminder entity.
     *
     * @Route("/", name="reminder_create")
     * @Method("POST")
     * @Template("LPDWTrainspovingBundle:Reminder:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Reminder();
        $form = $this->createForm(new ReminderType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('reminder_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new Reminder entity.
     *
     * @Route("/new", name="reminder_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Reminder();
        $form   = $this->createForm(new ReminderType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Reminder entity.
     *
     * @Route("/{id}", name="reminder_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LPDWTrainspovingBundle:Reminder')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Reminder entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Reminder entity.
     *
     * @Route("/{id}/edit", name="reminder_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LPDWTrainspovingBundle:Reminder')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Reminder entity.');
        }

        $editForm = $this->createForm(new ReminderType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Reminder entity.
     *
     * @Route("/{id}", name="reminder_update")
     * @Method("PUT")
     * @Template("LPDWTrainspovingBundle:Reminder:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LPDWTrainspovingBundle:Reminder')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Reminder entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new ReminderType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('reminder_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Reminder entity.
     *
     * @Route("/{id}", name="reminder_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('LPDWTrainspovingBundle:Reminder')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Reminder entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('reminder'));
    }

    /**
     * Creates a form to delete a Reminder entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
