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
     * @ORM\Column(name="deletedAt", type="datetime", nullable=true)
     */
    private $deletedAt;


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
}
