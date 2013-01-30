<?php

namespace AndroidDev\SiteBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * ArticleRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ArticleRepository extends EntityRepository
{

    public function findLastArticleByPage($page, $nb)
    {
        $deb = ($nb * $page) - ($nb);

        $query = $this->_em->createQuery('SELECT a FROM AndroidDevSiteBundle:Article a ORDER BY a.created DESC');
        $query->setMaxResults($nb);
        $query->setFirstResult($deb);
        return $query->getResult();
    }

    public function findLastUpdateArticle($nb)
    {
        $query = $this->_em->createQuery('SELECT a 
            FROM AndroidDevSiteBundle:Article a 
            JOIN a.Type t
            WHERE (t.id = 1 OR t.id = 2)
            ORDER BY a.updated DESC');
        $query->setMaxResults($nb);
        return $query->getResult();
    }

}
