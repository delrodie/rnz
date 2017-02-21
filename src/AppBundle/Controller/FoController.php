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
     * @Route("/annuaires/{page}/Listes-de-tous-les-professionnels-du-reseau-nzassa", requirements={"page" = "\d+"}, name="fo_annuaire")
     *
     * @param int $page Le numéro de la page
     */
    public function annuaireAction(Request $request, $page)
    {
      $recherche = new Recherche();
      $em = $this->getDoctrine()->getManager();
      $form = $this->createForm('AppBundle\Form\RechercheType', $recherche);
      $form->handleRequest($request);

      $nbBeneficiairesParPage = 10;

        $sliders = $em->getRepository('AppBundle:Slider')->getArticle();
        $domaines = $em->getRepository('AppBundle:Domaine')->getDomaine();
        $zones = $em->getRepository('AppBundle:Zone')->getZone();
        $beneficiaires = $em->getRepository('AppBundle:Beneficiaire')->getBeneficiaire($page, $nbBeneficiairesParPage);
        $evenements = $em->getRepository('AppBundle:Evenement')->getEvenement();
        $publicites = $em->getRepository('AppBundle:Publicite')->getPublicite();

        $pagination = array(
            'page' => $page,
            'nbPages' => ceil(count($beneficiaires) / $nbBeneficiairesParPage),
            'nomRoute' => 'fo_annuaire',
            'paramsRoute' => array()
        );

        return $this->render('fo/annuaire.html.twig', array(
            'sliders' => $sliders,
            'domaines' => $domaines,
            'zones' => $zones,
            'beneficiaires' => $beneficiaires,
            'evenements' => $evenements,
            'publicites' => $publicites,
            'recherche' => $recherche,
            'form' => $form->createView(),
            'pagination' => $pagination,
        ));
    }

    /**
     * @Route("/annuaires/{page}/liste-des-professionels-du-domaine-{libelle}_{domaine}", requirements={"page" = "\d+"}, name="fo_annuaire_recherche")
     *
     * @param int $page Le numéro de la page
     */
    public function annuairesAction(Request $request, $domaine, $zone = null, $libelle, $page)
    {
        $recherche = new Recherche();
        $form = $this->createForm('AppBundle\Form\RechercheType', $recherche);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();

        $nbBeneficiairesParPage = 10;
        //var_dump($libelle);
        //die($domaine);

        $sliders = $em->getRepository('AppBundle:Slider')->getArticle();
        $domaines = $em->getRepository('AppBundle:Domaine')->getDomaine();
        $zones = $em->getRepository('AppBundle:Zone')->getZone();
        $beneficiaires = $em->getRepository('AppBundle:Beneficiaire')->getAnnuaireByDomaine($domaine, $page, $nbBeneficiairesParPage);
        $evenements = $em->getRepository('AppBundle:Evenement')->getEvenement();
        $publicites = $em->getRepository('AppBundle:Publicite')->getPublicite();

        //die($domaine);

        $pagination = array(
            'page' => $page,
            'domaine' => $domaine,
            'libelle' => $libelle,
            'nbPages' => ceil(count($beneficiaires) / $nbBeneficiairesParPage),
            'nomRoute' => 'fo_annuaire_recherche',
            'paramsRoute' => array()
        );

        return $this->render('fo/annuaire-domaine.html.twig', array(
            'sliders' => $sliders,
            'domaines' => $domaines,
            'zones' => $zones,
            'beneficiaires' => $beneficiaires,
            'evenements' => $evenements,
            'publicites' => $publicites,
            'recherche' => $recherche,
            'form' => $form->createView(),
            'pagination' => $pagination,
        ));
    }

    /**
     * @Route("/annuaires/{page}/liste{zone}-des-professionels{domaine}", requirements={"page" = "\d+"}, name="fo_annuaire_recherche_page")
     *
     * @param int $page Le numéro de la page
     */
    public function rechercheAction(Request $request, $domaine, $zone, $page)
    {
        $recherche = new Recherche();
        $form = $this->createForm('AppBundle\Form\RechercheType', $recherche);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();

        $nbBeneficiairesParPage = 10;

        $sliders = $em->getRepository('AppBundle:Slider')->getArticle();
        $domaines = $em->getRepository('AppBundle:Domaine')->getDomaine();
        $zones = $em->getRepository('AppBundle:Zone')->getZone();
        $beneficiaires = $em->getRepository('AppBundle:Beneficiaire')->getAnnuaire($zone, $domaine, $page, $nbBeneficiairesParPage);
        $evenements = $em->getRepository('AppBundle:Evenement')->getEvenement();
        $publicites = $em->getRepository('AppBundle:Publicite')->getPublicite();

        $pagination = array(
            'page' => $page,
            'nbPages' => ceil(count($beneficiaires) / $nbBeneficiairesParPage),
            'nomRoute' => 'fo_annuaire_recherche_page',
            'paramsRoute' => array(),
            'zone'  => $zone,
            'domaine' => $domaine
        );

        return $this->render('recherche/new.html.twig', array(
            'sliders' => $sliders,
            'domaines' => $domaines,
            'zones' => $zones,
            'beneficiaires' => $beneficiaires,
            'evenements' => $evenements,
            'publicites' => $publicites,
            'recherche' => $recherche,
            'form' => $form->createView(),
            'pagination' => $pagination,
        ));
    }


}
