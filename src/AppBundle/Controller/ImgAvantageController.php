<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ImgAvantage;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Imgavantage controller.
 *
 * @Route("admin/imgavantage")
 */
class ImgAvantageController extends Controller
{
    /**
     * Lists all imgAvantage entities.
     *
     * @Route("/", name="admin_imgavantage_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $imgAvantages = $em->getRepository('AppBundle:ImgAvantage')->findAll();

        return $this->render('imgavantage/index.html.twig', array(
            'imgAvantages' => $imgAvantages,
        ));
    }

    /**
     * Creates a new imgAvantage entity.
     *
     * @Route("/new", name="admin_imgavantage_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $imgAvantage = new Imgavantage();
        $form = $this->createForm('AppBundle\Form\ImgAvantageType', $imgAvantage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($imgAvantage);
            $em->flush($imgAvantage);

            return $this->redirectToRoute('admin_imgavantage_show', array('id' => $imgAvantage->getId()));
        }

        return $this->render('imgavantage/new.html.twig', array(
            'imgAvantage' => $imgAvantage,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a imgAvantage entity.
     *
     * @Route("/{id}", name="admin_imgavantage_show")
     * @Method("GET")
     */
    public function showAction(ImgAvantage $imgAvantage)
    {
        $deleteForm = $this->createDeleteForm($imgAvantage);

        return $this->render('imgavantage/show.html.twig', array(
            'imgAvantage' => $imgAvantage,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing imgAvantage entity.
     *
     * @Route("/{id}/edit", name="admin_imgavantage_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ImgAvantage $imgAvantage)
    {
        $deleteForm = $this->createDeleteForm($imgAvantage);
        $editForm = $this->createForm('AppBundle\Form\ImgAvantageType', $imgAvantage);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_imgavantage_edit', array('id' => $imgAvantage->getId()));
        }

        return $this->render('imgavantage/edit.html.twig', array(
            'imgAvantage' => $imgAvantage,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a imgAvantage entity.
     *
     * @Route("/{id}", name="admin_imgavantage_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ImgAvantage $imgAvantage)
    {
        $form = $this->createDeleteForm($imgAvantage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($imgAvantage);
            $em->flush($imgAvantage);
        }

        return $this->redirectToRoute('admin_imgavantage_index');
    }

    /**
     * Creates a form to delete a imgAvantage entity.
     *
     * @param ImgAvantage $imgAvantage The imgAvantage entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ImgAvantage $imgAvantage)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_imgavantage_delete', array('id' => $imgAvantage->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
