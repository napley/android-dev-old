<?php

namespace AndroidDev\SiteBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * TypeRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TypeRepository extends EntityRepository
{

    public function findCat($type)
    {
        $query = $this->_em->createQuery('SELECT c FROM AndroidDevSiteBundle:Categorie c 
                        INNER JOIN c.Articles ac
                        INNER JOIN ac.Type act
                        WHERE act.id = :idType AND ac.visible = 1
                        GROUP BY c
                        ORDER BY c.nom');
        $query->setParameter('idType', $type);
        $cat = $query->getResult();
        
        return $cat;
    }

}