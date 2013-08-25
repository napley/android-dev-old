<?php

namespace AndroidDev\SiteBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * ProjetRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProjetRepository extends EntityRepository
{

    public function findNotEmpty()
    {
        $query = $this->_em->createQuery('SELECT p FROM AndroidDevSiteBundle:Projet p 
                        INNER JOIN p.Articles pa
                        WHERE p.visible = 1
                        ORDER BY p.titre');
        $projets = $query->getResult();

        return $projets;
    }

    public function findLastNotEmpty($nb)
    {
        $query = $this->_em->createQuery('SELECT p FROM AndroidDevSiteBundle:Projet p 
                        WHERE p.visible = 1
                        ORDER BY p.created DESC');
        $query->setMaxResults($nb);
        $projets = $query->getResult();

        return $projets;
    }

    public function listPartsByIndex($projet)
    {
        $listParts = array();
        foreach ($projet->getArticles() as $part) {
            $listParts[$part->getRang()] = $part->getArticle();
        }
        ksort($listParts);
        return $listParts;
    }

}
