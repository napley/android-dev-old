<?php

namespace AndroidDev\SiteBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * ArticleRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class StatRepository extends EntityRepository
{
    public function SortAllByRank()
    {
        $query = $this->_em->createQuery('SELECT s FROM AndroidDevSiteBundle:Stat s ORDER BY s.rank ASC');
        return $query->getResult();
    }

}
