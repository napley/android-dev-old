<?php

namespace AndroidDev\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Point
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AndroidDev\SiteBundle\Entity\PointRepository")
 * @Gedmo\SoftDeleteable(fieldName="deletedAt")
 */
class Point
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
     * @var float
     *
     * @ORM\Column(name="pct", type="float")
     */
    private $pct;

    /**
     * @var string
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(name="deletedAt", type="datetime", nullable=true)
     */
    public $deletedAt;

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
     * @ORM\ManyToOne(targetEntity="AndroidDev\SiteBundle\Entity\Android",
      inversedBy="Points")
     */
    private $Android;

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
     * Set sousTitre
     *
     * @param string $sousTitre
     * @return Article
     */
    public function setPct($pct)
    {
        $this->pct = $pct;

        return $this;
    }

    /**
     * Get sousTitre
     *
     * @return string 
     */
    public function getPct()
    {
        return $this->pct;
    }

    /**
     * Set contenu
     *
     * @param string $contenu
     * @return Article
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get contenu
     *
     * @return string 
     */
    public function getDate()
    {
        return $this->date;
    }

    public function getCreated()
    {
        return $this->created;
    }

    public function getUpdated()
    {
        return $this->updated;
    }
    

    /**
     * set Categorie
     * 
     * @param \AndroidDev\SiteBundle\Entity\Auteur $auteur
     */
    public function setAndroid(\AndroidDev\SiteBundle\Entity\Android $android)
    {
        if (!empty($this->Android)) {
            $this->removeAndroid();
        }
        $this->Android = $android;
    }

    /**
     * remove Categorie
     * 
     * @param \AndroidDev\SiteBundle\Entity\Auteur $auteur
     */
    public function removeAndroid()
    {
        $this->Android->removePoints($this);
    }

    /**
     * Get Categorie
     *
     * @return \AndroidDev\SiteBundle\Entity\Categorie
     */
    public function getAndroid()
    {
        return $this->Android;
    }
}
