<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Rubrique;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Rubrique controller.
 *
 * @Route("admin/rubrique")
 */
class RubriqueController extends Controller
{
    /**
     * Lists all rubrique entities.
     *
     * @Route("/", name="admin_rubrique_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $rubriques = $em->getRepository('AppBundle:Rubrique')->findAll();

        return $this->render('rubrique/index.html.twig', array(
            'rubriques' => $rubriques,
        ));
    }

    /**
     * Creates a new rubrique entity.
     *
     * @Route("/new", name="admin_rubrique_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $rubrique = new Rubrique();
        $form = $this->createForm('AppBundle\Form\RubriqueType', $rubrique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($rubrique);
            $em->flush($rubrique);

            return $this->redirectToRoute('admin_rubrique_new');
        }

        return $this->render('rubrique/new.html.twig', array(
            'rubrique' => $rubrique,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a rubrique entity.
     *
     * @Route("/{id}", name="admin_rubrique_show")
     * @Method("GET")
     */
    public function showAction(Rubrique $rubrique)
    {
        $deleteForm = $this->createDeleteForm($rubrique);

        return $this->render('rubrique/show.html.twig', array(
            'rubrique' => $rubrique,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing rubrique entity.
     *
     * @Route("/{id}/edit", name="admin_rubrique_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Rubrique $rubrique)
    {
        $deleteForm = $this->createDeleteForm($rubrique);
        $editForm = $this->createForm('AppBundle\Form\RubriqueType', $rubrique);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_rubrique_index');
        }

        return $this->render('rubrique/edit.html.twig', array(
            'rubrique' => $rubrique,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a rubrique entity.
     *
     * @Route("/{id}", name="admin_rubrique_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Rubrique $rubrique)
    {
        $form = $this->createDeleteForm($rubrique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($rubrique);
            $em->flush($rubrique);
        }

        return $this->redirectToRoute('admin_rubrique_index');
    }

    /**
     * Creates a form to delete a rubrique entity.
     *
     * @param Rubrique $rubrique The rubrique entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Rubrique $rubrique)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_rubrique_delete', array('id' => $rubrique->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
