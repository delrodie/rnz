<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Presentation;
use AppBundle\Entity\Avantage;
use AppBundle\Entity\Communaute;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 *
 */
class MenuController extends Controller
{

  /**
   * Menu de la rubrique presentation.
   *
   */
  public function presentationAction()
  {
      $em = $this->getDoctrine()->getManager();

      $presentations = $em->getRepository('AppBundle:Presentation')->findAll();

      return $this->render('menu/presentation.html.twig', array(
          'presentations' => $presentations,
      ));
  }

  /**
   * Menu de la rubrique presentation.
   *
   */
  public function avantageAction()
  {
      $em = $this->getDoctrine()->getManager();

      $avantages = $em->getRepository('AppBundle:Avantage')->findAll();

      return $this->render('menu/avantage.html.twig', array(
          'avantages' => $avantages,
      ));
  }

}
