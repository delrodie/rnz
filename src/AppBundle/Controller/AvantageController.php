<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Avantage;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Avantage controller.
 *
 * @Route("admin/avantage")
 */
class AvantageController extends Controller
{
    /**
     * Lists all avantage entities.
     *
     * @Route("/", name="admin_avantage_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $avantages = $em->getRepository('AppBundle:Avantage')->findAll();

        return $this->render('avantage/index.html.twig', array(
            'avantages' => $avantages,
        ));
    }

    /**
     * Creates a new avantage entity.
     *
     * @Route("/new", name="admin_avantage_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $avantage = new Avantage();
        $form = $this->createForm('AppBundle\Form\AvantageType', $avantage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($avantage);
            $em->flush($avantage);

            return $this->redirectToRoute('admin_avantage_show', array('slug' => $avantage->getSlug()));
        }

        return $this->render('avantage/new.html.twig', array(
            'avantage' => $avantage,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a avantage entity.
     *
     * @Route("/{slug}", name="admin_avantage_show")
     * @Method("GET")
     */
    public function showAction(Avantage $avantage)
    {
        $deleteForm = $this->createDeleteForm($avantage);

        return $this->render('avantage/show.html.twig', array(
            'avantage' => $avantage,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing avantage entity.
     *
     * @Route("/{slug}/edit", name="admin_avantage_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Avantage $avantage)
    {
        $deleteForm = $this->createDeleteForm($avantage);
        $editForm = $this->createForm('AppBundle\Form\AvantageType', $avantage);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_avantage_show', array('slug' => $avantage->getSlug()));
        }

        return $this->render('avantage/edit.html.twig', array(
            'avantage' => $avantage,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a avantage entity.
     *
     * @Route("/{id}", name="admin_avantage_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Avantage $avantage)
    {
        $form = $this->createDeleteForm($avantage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($avantage);
            $em->flush($avantage);
        }

        return $this->redirectToRoute('admin_avantage_index');
    }

    /**
     * Creates a form to delete a avantage entity.
     *
     * @param Avantage $avantage The avantage entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Avantage $avantage)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_avantage_delete', array('id' => $avantage->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
