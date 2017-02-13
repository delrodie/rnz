<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ImgContact;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Imgcontact controller.
 *
 * @Route("admin/imgcontact")
 */
class ImgContactController extends Controller
{
    /**
     * Lists all imgContact entities.
     *
     * @Route("/", name="admin_imgcontact_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $imgContacts = $em->getRepository('AppBundle:ImgContact')->findAll();

        return $this->render('imgcontact/index.html.twig', array(
            'imgContacts' => $imgContacts,
        ));
    }

    /**
     * Creates a new imgContact entity.
     *
     * @Route("/new", name="admin_imgcontact_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $imgContact = new Imgcontact();
        $form = $this->createForm('AppBundle\Form\ImgContactType', $imgContact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($imgContact);
            $em->flush($imgContact);

            return $this->redirectToRoute('admin_imgcontact_show', array('id' => $imgContact->getId()));
        }

        return $this->render('imgcontact/new.html.twig', array(
            'imgContact' => $imgContact,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a imgContact entity.
     *
     * @Route("/{id}", name="admin_imgcontact_show")
     * @Method("GET")
     */
    public function showAction(ImgContact $imgContact)
    {
        $deleteForm = $this->createDeleteForm($imgContact);

        return $this->render('imgcontact/show.html.twig', array(
            'imgContact' => $imgContact,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing imgContact entity.
     *
     * @Route("/{id}/edit", name="admin_imgcontact_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ImgContact $imgContact)
    {
        $deleteForm = $this->createDeleteForm($imgContact);
        $editForm = $this->createForm('AppBundle\Form\ImgContactType', $imgContact);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_imgcontact_edit', array('id' => $imgContact->getId()));
        }

        return $this->render('imgcontact/edit.html.twig', array(
            'imgContact' => $imgContact,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a imgContact entity.
     *
     * @Route("/{id}", name="admin_imgcontact_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ImgContact $imgContact)
    {
        $form = $this->createDeleteForm($imgContact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($imgContact);
            $em->flush($imgContact);
        }

        return $this->redirectToRoute('admin_imgcontact_index');
    }

    /**
     * Creates a form to delete a imgContact entity.
     *
     * @param ImgContact $imgContact The imgContact entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ImgContact $imgContact)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_imgcontact_delete', array('id' => $imgContact->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
