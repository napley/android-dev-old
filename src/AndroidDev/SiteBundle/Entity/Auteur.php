<?php

namespace AndroidDev\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Auteur
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AndroidDev\SiteBundle\Entity\AuteurRepository")
 * @Gedmo\SoftDeleteable(fieldName="deletedAt")
 */
class Auteur
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
     * @ORM\Column(name="nom", type="text")
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="text")
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="text")
     */
    private $mail;

    /**
     * @var string
     *
     * @ORM\Column(name="pseudo", type="text")
     */
    private $pseudo;

    /**
     * @var string
     *
     * @ORM\Column(name="lienProfil", type="text")
     */
    private $lienProfil;

    /**
     * @var string
     *
     * @ORM\Column(name="textPresentation", type="text")
     */
    private $textPresentation;

    /**
     * @ORM\Column(name="deletedAt", type="datetime", nullable=true)
     */
    private $deletedAt;

    /**
     * @ORM\OneToMany(targetEntity="AndroidDev\SiteBundle\Entity\Article",
      mappedBy="Auteur")
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
     * @return Auteur
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
     * Set prenom
     *
     * @param string $prenom
     * @return Auteur
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string 
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set mail
     *
     * @param string $mail
     * @return Auteur
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail
     *
     * @return string 
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set pseudo
     *
     * @param string $pseudo
     * @return Auteur
     */
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    /**
     * Get pseudo
     *
     * @return string 
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * Set lienProfil
     *
     * @param string $lienProfil
     * @return Auteur
     */
    public function setLienProfil($lienProfil)
    {
        $this->lienProfil = $lienProfil;

        return $this;
    }

    /**
     * Get lienProfil
     *
     * @return string 
     */
    public function getLienProfil()
    {
        return $this->lienProfil;
    }

    /**
     * Set textPresentation
     *
     * @param string $textPresentation
     * @return Auteur
     */
    public function setTextPresentation($textPresentation)
    {
        $this->textPresentation = $textPresentation;

        return $this;
    }

    /**
     * Get textPresentation
     *
     * @return string 
     */
    public function getTextPresentation()
    {
        return $this->textPresentation;
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

