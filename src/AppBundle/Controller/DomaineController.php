<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Domaine;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Domaine controller.
 *
 * @Route("admin/domaine")
 */
class DomaineController extends Controller
{
    /**
     * Lists all domaine entities.
     *
     * @Route("/", name="admin_domaine_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $domaines = $em->getRepository('AppBundle:Domaine')->findAll();

        return $this->render('domaine/index.html.twig', array(
            'domaines' => $domaines,
        ));
    }

    /**
     * Creates a new domaine entity.
     *
     * @Route("/new", name="admin_domaine_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $domaine = new Domaine();
        $form = $this->createForm('AppBundle\Form\DomaineType', $domaine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            // Recuperation du code
            $dernierId = $em->getRepository('AppBundle:Domaine')->getDernierId();

            $domaine->setCode($dernierId);

            $em->persist($domaine);
            $em->flush($domaine);

            return $this->redirectToRoute('admin_domaine_index');
        }

        return $this->render('domaine/new.html.twig', array(
            'domaine' => $domaine,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a domaine entity.
     *
     * @Route("/{id}", name="admin_domaine_show")
     * @Method("GET")
     */
    public function showAction(Domaine $domaine)
    {
        $deleteForm = $this->createDeleteForm($domaine);

        return $this->render('domaine/show.html.twig', array(
            'domaine' => $domaine,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing domaine entity.
     *
     * @Route("/{id}/edit", name="admin_domaine_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Domaine $domaine)
    {
        $deleteForm = $this->createDeleteForm($domaine);
        $editForm = $this->createForm('AppBundle\Form\DomaineType', $domaine);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_domaine_index');
        }

        return $this->render('domaine/edit.html.twig', array(
            'domaine' => $domaine,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a domaine entity.
     *
     * @Route("/{id}", name="admin_domaine_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Domaine $domaine)
    {
        $form = $this->createDeleteForm($domaine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($domaine);
            $em->flush($domaine);
        }

        return $this->redirectToRoute('admin_domaine_index');
    }

    /**
     * Creates a form to delete a domaine entity.
     *
     * @param Domaine $domaine The domaine entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Domaine $domaine)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_domaine_delete', array('id' => $domaine->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
