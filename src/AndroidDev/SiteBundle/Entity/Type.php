<?php

namespace AndroidDev\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Type
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AndroidDev\SiteBundle\Entity\TypeRepository")
 * @Gedmo\SoftDeleteable(fieldName="deletedAt")
 */
class Type
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
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @Gedmo\Slug(fields={"nom"})
     * @ORM\Column(length=128, unique=true)
     */
    private $slug;


    /**
     * @ORM\Column(name="deletedAt", type="datetime", nullable=true)
     */
    private $deletedAt;
    
    /**
     * @ORM\OneToMany(targetEntity="AndroidDev\SiteBundle\Entity\Article",
      mappedBy="Type")
     */
    private $Articles;

    
    public function __construct()
    {
        $this->Articles = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set nom
     *
     * @param string $nom
     * @return Type
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    
        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Type
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    
        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }
    
    
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;
    }
    
    public function addArticle(\AndroidDev\SiteBundle\Entity\Article $article)
    {
        $this->Articles[] = $article;
        return $this;
    }

    public function removeArticle(\AndroidDev\SiteBundle\Entity\Article $article)
    {
        $this->Articles->removeElement($article);
    }

    public function getArticles()
    {
        return $this->Articles;
    }

}
