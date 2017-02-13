<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ImgPublicite;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Imgpublicite controller.
 *
 * @Route("admin/imgpublicite")
 */
class ImgPubliciteController extends Controller
{
    /**
     * Lists all imgPublicite entities.
     *
     * @Route("/", name="admin_imgpublicite_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $imgPublicites = $em->getRepository('AppBundle:ImgPublicite')->findAll();

        return $this->render('imgpublicite/index.html.twig', array(
            'imgPublicites' => $imgPublicites,
        ));
    }

    /**
     * Creates a new imgPublicite entity.
     *
     * @Route("/new", name="admin_imgpublicite_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $imgPublicite = new Imgpublicite();
        $form = $this->createForm('AppBundle\Form\ImgPubliciteType', $imgPublicite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($imgPublicite);
            $em->flush($imgPublicite);

            return $this->redirectToRoute('admin_imgpublicite_show', array('id' => $imgPublicite->getId()));
        }

        return $this->render('imgpublicite/new.html.twig', array(
            'imgPublicite' => $imgPublicite,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a imgPublicite entity.
     *
     * @Route("/{id}", name="admin_imgpublicite_show")
     * @Method("GET")
     */
    public function showAction(ImgPublicite $imgPublicite)
    {
        $deleteForm = $this->createDeleteForm($imgPublicite);

        return $this->render('imgpublicite/show.html.twig', array(
            'imgPublicite' => $imgPublicite,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing imgPublicite entity.
     *
     * @Route("/{id}/edit", name="admin_imgpublicite_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ImgPublicite $imgPublicite)
    {
        $deleteForm = $this->createDeleteForm($imgPublicite);
        $editForm = $this->createForm('AppBundle\Form\ImgPubliciteType', $imgPublicite);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_imgpublicite_edit', array('id' => $imgPublicite->getId()));
        }

        return $this->render('imgpublicite/edit.html.twig', array(
            'imgPublicite' => $imgPublicite,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a imgPublicite entity.
     *
     * @Route("/{id}", name="admin_imgpublicite_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ImgPublicite $imgPublicite)
    {
        $form = $this->createDeleteForm($imgPublicite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($imgPublicite);
            $em->flush($imgPublicite);
        }

        return $this->redirectToRoute('admin_imgpublicite_index');
    }

    /**
     * Creates a form to delete a imgPublicite entity.
     *
     * @param ImgPublicite $imgPublicite The imgPublicite entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ImgPublicite $imgPublicite)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_imgpublicite_delete', array('id' => $imgPublicite->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
