<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Recherche;

class FoController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $sliders = $em->getRepository('AppBundle:Slider')->getArticle();
        $domaines = $em->getRepository('AppBundle:Domaine')->getDomaine();
        $avantages = $em->getRepository('AppBundle:Avantage')->getAvantage();
        $evenements = $em->getRepository('AppBundle:Evenement')->getEvenement();
        $publicites = $em->getRepository('AppBundle:Publicite')->getPublicite();

        return $this->render('fo/index.html.twig', array(
            'sliders' => $sliders,
            'domaines' => $domaines,
            'avantages' => $avantages,
            'evenements' => $evenements,
            'publicites' => $publicites,
        ));
    }

    /**
     * @Route("/qui-sommes-nous/", name="fo_presentation")
     */
    public function presentationAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $sliders = $em->getRepository('AppBundle:Slider')->getArticle();
        $domaines = $em->getRepository('AppBundle:Domaine')->getDomaine();
        $presentations = $em->getRepository('AppBundle:Presentation')->getPresentation();
        $evenements = $em->getRepository('AppBundle:Evenement')->getEvenement();
        $publicites = $em->getRepository('AppBundle:Publicite')->getPublicite();

        return $this->render('fo/presentation.html.twig', array(
            'sliders' => $sliders,
            'domaines' => $domaines,
            'presentations' => $presentations,
            'evenements' => $evenements,
            'publicites' => $publicites,
        ));
    }

    /**
     * @Route("/nous-contacter/", name="fo_contact")
     */
    public function contactAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $sliders = $em->getRepository('AppBundle:Slider')->getArticle();
        $domaines = $em->getRepository('AppBundle:Domaine')->getDomaine();
        $contacts = $em->getRepository('AppBundle:Contact')->getContact();
        $evenements = $em->getRepository('AppBundle:Evenement')->getEvenement();
        $publicites = $em->getRepository('AppBundle:Publicite')->getPublicite();

        return $this->render('fo/contact.html.twig', array(
            'sliders' => $sliders,
            'domaines' => $domaines,
            'contacts' => $contacts,
            'evenements' => $evenements,
            'publicites' => $publicites,
        ));
    }

    /**
     * @Route("/annuaires/", name="fo_annuaire")
     */
    public function annuaireAction(Request $request)
    {
      $recherche = new Recherche();
      $em = $this->getDoctrine()->getManager();
      $form = $this->createForm('AppBundle\Form\RechercheType', $recherche);
      $form->handleRequest($request);

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

    /**
     * @Route("/annuaires/{domaine}/liste-des-professionels", name="fo_annuaire_recherche")
     */
    public function annuairesAction(Request $request, $domaine = null, $zone = null)
    {
        $recherche = new Recherche();
        $form = $this->createForm('AppBundle\Form\RechercheType', $recherche);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();

        $sliders = $em->getRepository('AppBundle:Slider')->getArticle();
        $domaines = $em->getRepository('AppBundle:Domaine')->getDomaine();
        $zones = $em->getRepository('AppBundle:Zone')->getZone();
        $beneficiaires = $em->getRepository('AppBundle:Beneficiaire')->getAnnuaireByDomaine($domaine);
        $evenements = $em->getRepository('AppBundle:Evenement')->getEvenement();
        $publicites = $em->getRepository('AppBundle:Publicite')->getPublicite();
        //var_dump($beneficiaires);
        //die();

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
