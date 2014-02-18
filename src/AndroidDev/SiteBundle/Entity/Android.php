<?php

namespace AndroidDev\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Article
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AndroidDev\SiteBundle\Entity\AndroidRepository")
 * @Gedmo\SoftDeleteable(fieldName="deletedAt")
 */
class Android
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
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=100)
     */
    private $code;

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
     * @ORM\OneToMany(targetEntity="AndroidDev\SiteBundle\Entity\Point",
      mappedBy="Android")
     */
    private $Points;

    public function __construct()
    {
        $this->Points = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString()
    {
        return $this->titre . ' (' . $this->code . ')';
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
     * Set titre
     *
     * @param string $titre
     * @return Article
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set titre
     *
     * @param string $titre
     * @return Article
     */
    public function setCode($code)
    {
        $this->code = $code;

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

    public function addPoint(\AndroidDev\SiteBundle\Entity\Point $Point)
    {
        $this->Points[] = $Point;
        return $this;
    }

    public function removePoint(\AndroidDev\SiteBundle\Entity\Point $Point)
    {
        $this->Points->removeElement($Point);
    }

    public function getPoints()
    {
        return $this->Points;
    }

    public function getCreated()
    {
        return $this->created;
    }

    public function getUpdated()
    {
        return $this->updated;
    }

}
