<?php

namespace AndroidDev\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ArticleProjet
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AndroidDev\SiteBundle\Entity\ArticleProjetRepository")
 */
class ArticleProjet
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
     * @var integer
     *
     * @ORM\Column(name="rang", type="integer")
     */
    private $rang;

    /**
     * @ORM\OneToOne(targetEntity="AndroidDev\SiteBundle\Entity\Article", inversedBy="Projet", cascade={"persist", "remove"})
     * */
    private $Article;
    

    public function __construct(AndroidDev\SiteBundle\Entity\Article $article, $index)
    {
        $this->setArticle($article);
        $this->setRang($index);
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
     * Set rang
     *
     * @param integer $rang
     * @return ArticleProjet
     */
    public function setRang($rang)
    {
        $this->rang = $rang;

        return $this;
    }

    /**
     * Get rang
     *
     * @return integer 
     */
    public function getRang()
    {
        return $this->rang;
    }

    /**
     * Set Article
     * 
     * @param \AndroidDev\SiteBundle\Entity\Article $article
     * @return \AndroidDev\SiteBundle\Entity\ArticleProjet
     */
    public function AddArticles(\AndroidDev\SiteBundle\Entity\Article $article, $index)
    {
        $this->Articles[] = new ArticleProjet($article, $index);
    }

    /**
     * Get Article
     *
     * @return integer 
     */
    public function getArticles()
    {
        return $this->Articles;
    }

}
