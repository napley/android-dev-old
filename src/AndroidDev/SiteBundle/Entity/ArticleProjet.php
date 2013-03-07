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
     * @ORM\OneToOne(targetEntity="AndroidDev\SiteBundle\Entity\Article", inversedBy="Projet", cascade={"persist"})
     * */
    private $Article;
    

    /**
     * @ORM\ManyToOne(targetEntity="AndroidDev\SiteBundle\Entity\Projet", cascade={"persist"},
      inversedBy="articles")
     */
    private $Projet;

    public function __construct( $projet, $article, $index)
    {
        $this->setArticle($article);
        $this->setProjet($projet);
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
     * Set rang
     *
     * @param integer $rang
     * @return ArticleProjet
     */
    public function setArticle($article)
    {
        $this->Article = $article;

        return $this;
    }

    /**
     * Add Article
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
    public function getArticle()
    {
        return $this->Article;
    }

    /**
     * Set rang
     *
     * @param integer $rang
     * @return ArticleProjet
     */
    public function setProjet($project)
    {
        $this->Projet = $project;

        return $this;
    }


}
