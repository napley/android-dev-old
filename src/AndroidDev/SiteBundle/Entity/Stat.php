<?php

namespace AndroidDev\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Article
 *
 * @ORM\Table(name="stat")
 * @ORM\Entity(repositoryClass="AndroidDev\SiteBundle\Entity\StatRepository")
 */
class Stat
{

    /**
     * @var integer
     * 
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="rank", type="integer")
     */
    private $rank;
    
    /**
     * @ORM\OneToOne(targetEntity="AndroidDev\SiteBundle\Entity\Article")
     * @ORM\JoinColumn(name="article_id", referencedColumnName="id")
     */
    private $Article;


    public function __construct()
    {
        
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set rank
     *
     * @param int $rank
     * @return \AndroidDev\SiteBundle\Entity\Stat
     */
    public function setRank($rank)
    {
        $this->rank = $rank;

        return $this;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set titre
     *
     * @param string $titre
     * @return Article
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get rank
     *
     * @return int 
     */
    public function getRank()
    {
        return $this->rank;
    }

    /**
     * set Article
     * 
     * @param \AndroidDev\SiteBundle\Entity\Article $article
     */
    public function setArticle(\AndroidDev\SiteBundle\Entity\Article $article)
    {
        $this->Article = $article;
    }

    /**
     * get Article
     * 
     * @return \AndroidDev\SiteBundle\Entity\Article $article
     */
    public function getArticle()
    {
        return $this->Article;
    }
}
