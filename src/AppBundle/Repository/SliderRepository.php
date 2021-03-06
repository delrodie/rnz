<?php

namespace AppBundle\Repository;

/**
 * SliderRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class SliderRepository extends \Doctrine\ORM\EntityRepository
{
  /**
    * Recherche de l'article de la rubrique slider
    *
    * Author: Delrodie AMOIKON
    * Date: 14/02/2017
    * Since: v1.0
    */
    public function getArticle()
    {
        $em = $this->getEntityManager();
        $qb = $em->createQuery('
            SELECT s
            FROM AppBundle:Slider s
            WHERE s.statut = :stat
        ')
          ->setParameter('stat', 1)
        ;
        try {
            $result = $qb->getResult();

            return $result;

        } catch (NoResultException $e) {
            return $e;
        }

    }
}
