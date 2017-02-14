<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Beneficiaire;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Beneficiaire controller.
 *
 * @Route("admin/beneficiaire")
 */
class BeneficiaireController extends Controller
{
    /**
     * Lists all beneficiaire entities.
     *
     * @Route("/", name="admin_beneficiaire_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $beneficiaires = $em->getRepository('AppBundle:Beneficiaire')->findAll();

        return $this->render('beneficiaire/index.html.twig', array(
            'beneficiaires' => $beneficiaires,
        ));
    }

    /**
     * Creates a new beneficiaire entity.
     *
     * @Route("/new", name="admin_beneficiaire_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $beneficiaire = new Beneficiaire();
        $form = $this->createForm('AppBundle\Form\BeneficiaireType', $beneficiaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($beneficiaire);
            $em->flush($beneficiaire);

            return $this->redirectToRoute('admin_beneficiaire_show', array('id' => $beneficiaire->getId()));
        }

        return $this->render('beneficiaire/new.html.twig', array(
            'beneficiaire' => $beneficiaire,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a beneficiaire entity.
     *
     * @Route("/{id}", name="admin_beneficiaire_show")
     * @Method("GET")
     */
    public function showAction(Beneficiaire $beneficiaire)
    {
        $deleteForm = $this->createDeleteForm($beneficiaire);

        return $this->render('beneficiaire/show.html.twig', array(
            'beneficiaire' => $beneficiaire,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing beneficiaire entity.
     *
     * @Route("/{id}/edit", name="admin_beneficiaire_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Beneficiaire $beneficiaire)
    {
        $deleteForm = $this->createDeleteForm($beneficiaire);
        $editForm = $this->createForm('AppBundle\Form\BeneficiaireType', $beneficiaire);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_beneficiaire_edit', array('id' => $beneficiaire->getId()));
        }

        return $this->render('beneficiaire/edit.html.twig', array(
            'beneficiaire' => $beneficiaire,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a beneficiaire entity.
     *
     * @Route("/{id}", name="admin_beneficiaire_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Beneficiaire $beneficiaire)
    {
        $form = $this->createDeleteForm($beneficiaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($beneficiaire);
            $em->flush($beneficiaire);
        }

        return $this->redirectToRoute('admin_beneficiaire_index');
    }

    /**
     * Creates a form to delete a beneficiaire entity.
     *
     * @param Beneficiaire $beneficiaire The beneficiaire entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Beneficiaire $beneficiaire)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_beneficiaire_delete', array('id' => $beneficiaire->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
