<?php

namespace AndroidDev\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * InfoSite
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AndroidDev\SiteBundle\Entity\InfoSiteRepository")
 * @Gedmo\SoftDeleteable(fieldName="deletedAt")
 */
class InfoSite
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
     * @ORM\Column(name="titre", type="text")
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="entete", type="text")
     */
    private $entete;

    /**
     * @var string
     *
     * @ORM\Column(name="footer", type="text")
     */
    private $footer;

    /**
     * @var string
     *
     * @ORM\Column(name="aPropos", type="text")
     */
    private $aPropos;

    /**
     * @var string
     *
     * @ORM\Column(name="codeSocial", type="text")
     */
    private $codeSocial;

    /**
     * @var string
     *
     * @ORM\Column(name="codeAnalytics", type="text")
     */
    private $codeAnalytics;

    /**
     * @var int
     * 
     * @ORM\Column(name="nbByPage", type="integer")
     */
    private $nbByPage;

    /**
     * @ORM\Column(name="deletedAt", type="datetime", nullable=true)
     */
    private $deletedAt;

    /**
     * @var datetime $created
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @var datetime $updated
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $updated;


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
     * Set titre
     *
     * @param string $titre
     * @return InfoSite
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    
        return $this;
    }

    /**
     * Get titre
     *
     * @return string 
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return InfoSite
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get Description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set entete
     *
     * @param string $entete
     * @return InfoSite
     */
    public function setEntete($entete)
    {
        $this->entete = $entete;
    
        return $this;
    }

    /**
     * Get entete
     *
     * @return string 
     */
    public function getEntete()
    {
        return $this->entete;
    }

    /**
     * Set footer
     *
     * @param string $footer
     * @return InfoSite
     */
    public function setFooter($footer)
    {
        $this->footer = $footer;
    
        return $this;
    }

    /**
     * Get footer
     *
     * @return string 
     */
    public function getFooter()
    {
        return $this->footer;
    }

    /**
     * Set aPropos
     *
     * @param string $aPropos
     * @return InfoSite
     */
    public function setAPropos($aPropos)
    {
        $this->aPropos = $aPropos;
    
        return $this;
    }

    /**
     * Get aPropos
     *
     * @return string 
     */
    public function getAPropos()
    {
        return $this->aPropos;
    }

    /**
     * Set codeSocial
     *
     * @param string $codeSocial
     * @return InfoSite
     */
    public function setCodeSocial($codeSocial)
    {
        $this->codeSocial = $codeSocial;
    
        return $this;
    }

    /**
     * Get codeSocial
     *
     * @return string 
     */
    public function getCodeSocial()
    {
        return $this->codeSocial;
    }

    /**
     * Set codeAnalytics
     *
     * @param string $codeAnalytics
     * @return InfoSite
     */
    public function setCodeAnalytics($codeAnalytics)
    {
        $this->codeAnalytics = $codeAnalytics;
    
        return $this;
    }

    /**
     * Get codeAnalytics
     *
     * @return string 
     */
    public function getCodeAnalytics()
    {
        return $this->codeAnalytics;
    }

    /**
     * Set nbByPage
     *
     * @param string $codeAnalytics
     * @return InfoSite
     */
    public function setNbByPage($nb)
    {
        $this->nbByPage = $nb;
    
        return $this;
    }

    /**
     * Get nbByPage
     *
     * @return string 
     */
    public function getNbByPage()
    {
        return $this->nbByPage;
    }
}
