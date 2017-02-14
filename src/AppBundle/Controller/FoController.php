<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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
}
