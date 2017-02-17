<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Recherche;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Recherche controller.
 *
 * @Route("annuaire")
 */
class RechercheController extends Controller
{
    /**
     * Lists all recherche entities.
     *
     * @Route("/", name="recherche_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $recherches = $em->getRepository('AppBundle:Recherche')->findAll();

        return $this->render('recherche/index.html.twig', array(
            'recherches' => $recherches,
        ));
    }

    /**
     * Creates a new recherche entity.
     *
     * @Route("/liste-des-professionels", name="recherche_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $recherche = new Recherche();
        $form = $this->createForm('AppBundle\Form\RechercheType', $recherche);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            //$em->persist($recherche);
            //$em->flush($recherche);
            //return $this->redirectToRoute('recherche_show', array('id' => $recherche->getId()));
            $zone = $recherche->getZone();
            $domaine = $recherche->getDomaine();
            //die($domaine);

            $sliders = $em->getRepository('AppBundle:Slider')->getArticle();
            $domaines = $em->getRepository('AppBundle:Domaine')->getDomaine();
            $zones = $em->getRepository('AppBundle:Zone')->getZone();
            $beneficiaires = $em->getRepository('AppBundle:Beneficiaire')->getAnnuaire($zone, $domaine);
            $evenements = $em->getRepository('AppBundle:Evenement')->getEvenement();
            $publicites = $em->getRepository('AppBundle:Publicite')->getPublicite();

            return $this->render('fo/annuaire.html.twig', array(
                'sliders' => $sliders,
                'domaines' => $domaines,
                'zones' => $zones,
                'beneficiaires' => $beneficiaires,
                'evenements' => $evenements,
                'publicites' => $publicites,
                'recherche' => $recherche,
                'form' => $form->createView(),
            ));
        }

        $sliders = $em->getRepository('AppBundle:Slider')->getArticle();
        $domaines = $em->getRepository('AppBundle:Domaine')->getDomaine();
        $zones = $em->getRepository('AppBundle:Zone')->getZone();
        $beneficiaires = $em->getRepository('AppBundle:Beneficiaire')->getBeneficiaire();
        $evenements = $em->getRepository('AppBundle:Evenement')->getEvenement();
        $publicites = $em->getRepository('AppBundle:Publicite')->getPublicite();

        return $this->render('fo/annuaire.html.twig', array(
            'recherche' => $recherche,
            'form' => $form->createView(),
            'sliders' => $sliders,
            'domaines' => $domaines,
            'zones' => $zones,
            'beneficiaires' => $beneficiaires,
            'evenements' => $evenements,
            'publicites' => $publicites,
        ));
    }

    /**
     * Finds and displays a recherche entity.
     *
     * @Route("/{id}", name="recherche_show")
     * @Method("GET")
     */
    public function showAction(Recherche $recherche)
    {
        $deleteForm = $this->createDeleteForm($recherche);

        return $this->render('recherche/show.html.twig', array(
            'recherche' => $recherche,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing recherche entity.
     *
     * @Route("/{id}/edit", name="recherche_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Recherche $recherche)
    {
        $deleteForm = $this->createDeleteForm($recherche);
        $editForm = $this->createForm('AppBundle\Form\RechercheType', $recherche);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('recherche_edit', array('id' => $recherche->getId()));
        }

        return $this->render('recherche/edit.html.twig', array(
            'recherche' => $recherche,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a recherche entity.
     *
     * @Route("/{id}", name="recherche_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Recherche $recherche)
    {
        $form = $this->createDeleteForm($recherche);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($recherche);
            $em->flush($recherche);
        }

        return $this->redirectToRoute('recherche_index');
    }

    /**
     * Creates a form to delete a recherche entity.
     *
     * @param Recherche $recherche The recherche entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Recherche $recherche)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('recherche_delete', array('id' => $recherche->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /**
     * @Route("/annuaire/liste-des-professionnels/", name="fo_annuaire_liste")
     */
    public function annuairelisteAction(Request $request, Recherche $recherche)
    {
        $recherche = new Recherche();
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm('AppBundle\Form\RechercheType', $recherche);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            die();
            $em = $this->getDoctrine()->getManager();
            $zone = $recherche->getZone();
            $domaine = $recherche->getDomaine();

            $sliders = $em->getRepository('AppBundle:Slider')->getArticle();
            $domaines = $em->getRepository('AppBundle:Domaine')->getDomaine();
            $zones = $em->getRepository('AppBundle:Zone')->getZone();
            $beneficiaires = $em->getRepository('AppBundle:Beneficiaire')->getAnnuaire($zone, $domaine);
            $evenements = $em->getRepository('AppBundle:Evenement')->getEvenement();
            $publicites = $em->getRepository('AppBundle:Publicite')->getPublicite();

            return $this->render('fo/annuaire.html.twig', array(
                'sliders' => $sliders,
                'domaines' => $domaines,
                'zones' => $zones,
                'beneficiaires' => $beneficiaires,
                'evenements' => $evenements,
                'publicites' => $publicites,
                'recherche' => $recherche,
                'form' => $form->createView(),
            ));

        }


        $sliders = $em->getRepository('AppBundle:Slider')->getArticle();
        $domaines = $em->getRepository('AppBundle:Domaine')->getDomaine();
        $zones = $em->getRepository('AppBundle:Zone')->getZone();
        $beneficiaires = $em->getRepository('AppBundle:Beneficiaire')->getBeneficiaire();
        $evenements = $em->getRepository('AppBundle:Evenement')->getEvenement();
        $publicites = $em->getRepository('AppBundle:Publicite')->getPublicite();

        return $this->render('fo/annuaire.html.twig', array(
            'sliders' => $sliders,
            'domaines' => $domaines,
            'zones' => $zones,
            'beneficiaires' => $beneficiaires,
            'evenements' => $evenements,
            'publicites' => $publicites,
            'recherche' => $recherche,
            'form' => $form->createView(),
        ));
    }
}
