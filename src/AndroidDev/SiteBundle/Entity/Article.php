<?php

namespace AndroidDev\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Eko\FeedBundle\Item\Writer\ItemInterface;

/**
 * Article
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AndroidDev\SiteBundle\Entity\ArticleRepository")
 * @Gedmo\SoftDeleteable(fieldName="deletedAt")
 */
class Article implements ItemInterface
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
     * @ORM\Column(name="vignette", type="string", length=255, nullable=true)
     */
    private $vignette;

    /**
     * @var string
     *
     * @ORM\Column(name="sousTitre", type="text")
     */
    private $sousTitre;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="text")
     */
    private $contenu;

    /**
     * @var boolean
     *
     * @ORM\Column(name="visible", type="boolean")
     */
    private $visible = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="top", type="boolean")
     */
    private $top = false;

    /**
     * @Gedmo\Slug(fields={"titre"}, updatable=false, separator="_")
     * @ORM\Column(length=128, unique=true)
     */
    private $slug;

    /**
     * @ORM\Column(name="publishedAt", type="datetime", nullable=true)
     */
    private $publishedAt;

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
     * @ORM\ManyToOne(targetEntity="AndroidDev\SiteBundle\Entity\Type",
      inversedBy="Articles")
     */
    private $Type;

    /**
     * @ORM\ManyToOne(targetEntity="AndroidDev\UserBundle\Entity\User", cascade={"persist", "remove"},
      inversedBy="Articles")
     */
    private $Auteur;

    /**
     * @ORM\ManyToOne(targetEntity="AndroidDev\SiteBundle\Entity\Categorie",
      inversedBy="Articles")
     */
    private $Categorie;

    /**
     * @ORM\OneToOne(targetEntity="AndroidDev\SiteBundle\Entity\ArticleProjet", mappedBy="Article", cascade={"persist", "remove"})
     */
    private $Projet;
    
    /**
     * @ORM\ManyToMany(targetEntity="AndroidDev\SiteBundle\Entity\MotCle", inversedBy="Articles", cascade={"persist"})
     * @ORM\JoinTable(name="article_motcles")
     * */
    private $MotCles;

    public function __construct()
    {
        $this->MotCles = new \Doctrine\Common\Collections\ArrayCollection();
        $this->publishedAt = new \DateTime();
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
    public function getVisible()
    {
        return $this->visible;
    }

    /**
     * Set titre
     *
     * @param string $titre
     * @return Article
     */
    public function setVisible($visible)
    {
        $this->visible = $visible;

        return $this;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getTop()
    {
        return $this->top;
    }

    /**
     * Set titre
     *
     * @param string $titre
     * @return Article
     */
    public function setTop($top)
    {
        $this->top = $top;

        return $this;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getVignette()
    {
        if (empty($this->vignette) && !empty($this->Type) && $this->Type->getId() != 3) {
            if (!empty($this->Categorie)) {
                $vignette = $this->Categorie->getVignette();
                if (!empty($vignette)) {
                    return $this->Categorie->getVignette();
                }
            } else {
                return '';
            }
        } elseif (empty($this->vignette) && !empty($this->Type) && $this->Type->getId() == 3) {
            if (!empty($this->Projet)) {
                $vignette = $this->Projet->getProjet()->getVignette();
                if (!empty($vignette)) {
                    return $this->Projet->getProjet()->getVignette();
                }
            } else {
                return '';
            }
        } else {
            return $this->vignette;
        }
    }

    /**
     * Set titre
     *
     * @param string $titre
     * @return Article
     */
    public function setVignette($vignette)
    {
        $this->vignette = $vignette;

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
     * Set sousTitre
     *
     * @param string $sousTitre
     * @return Article
     */
    public function setSousTitre($sousTitre)
    {
        $this->sousTitre = $sousTitre;

        return $this;
    }

    /**
     * Get sousTitre
     *
     * @return string 
     */
    public function getSousTitre()
    {
        return $this->sousTitre;
    }

    /**
     * Set contenu
     *
     * @param string $contenu
     * @return Article
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get contenu
     *
     * @return string 
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Article
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

    public function getCreated()
    {
        return $this->created;
    }

    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * set Type
     * 
     * @param \AndroidDev\SiteBundle\Entity\Type $type
     */
    public function setType(\AndroidDev\SiteBundle\Entity\Type $type)
    {
        if (!empty($this->Type)) {
            $this->removeType();
        }
        $this->Type = $type;
    }

    /**
     * remove Type
     * 
     * @param \AndroidDev\SiteBundle\Entity\Type $type
     */
    public function removeType()
    {
        $this->Type->removeArticle($this);
    }

    /**
     * Get Type
     *
     * @return \AndroidDev\SiteBundle\Entity\Type
     */
    public function getType()
    {
        return $this->Type;
    }

    /**
     * set Auteur
     * 
     * @param \AndroidDev\UserBundle\Entity\User $auteur
     */
    public function setAuteur(\AndroidDev\UserBundle\Entity\User $auteur)
    {
        if (!empty($this->Auteur)) {
            $this->removeAuteur();
        }
        $this->Auteur = $auteur;
    }

    /**
     * remove Auteur
     * 
     * @param \AndroidDev\UserBundle\Entity\Auteur $auteur
     */
    public function removeAuteur()
    {
        $this->Auteur->removeArticle($this);
    }

    /**
     * Get Auteur
     *
     * @return \AndroidDev\SiteBundle\Entity\Auteur
     */
    public function getAuteur()
    {
        return $this->Auteur;
    }

    /**
     * set Categorie
     * 
     * @param \AndroidDev\SiteBundle\Entity\Auteur $auteur
     */
    public function setCategorie(\AndroidDev\SiteBundle\Entity\Categorie $categorie)
    {
        if (!empty($this->Categorie)) {
            $this->removeCategorie();
        }
        $this->Categorie = $categorie;
    }

    /**
     * remove Categorie
     * 
     * @param \AndroidDev\SiteBundle\Entity\Auteur $auteur
     */
    public function removeCategorie()
    {
        $this->Categorie->removeArticle($this);
    }

    /**
     * Get Categorie
     *
     * @return \AndroidDev\SiteBundle\Entity\Categorie
     */
    public function getCategorie()
    {
        if (!empty($this->Type) && $this->Type->getId() == 3) {
            if (!empty($this->Projet)) {
                return $this->Projet->getProjet();
            } else {
                return $this->Categorie;
            }
        } else {
            return $this->Categorie;
        }
    }

    public function setProjet(\AndroidDev\SiteBundle\Entity\Projet $projet, $index)
    {
        if (!empty($this->Projet)) {
            $this->removeProjet();
        }
        $this->Projet = new ArticleProjet($projet, $index);
    }

    /**
     * remove Categorie
     * 
     * @param \AndroidDev\SiteBundle\Entity\Auteur $auteur
     */
    public function removeProjet()
    {
        $this->Projet->removeProjet($this);
    }

    /**
     * Get Categorie
     *
     * @return \AndroidDev\SiteBundle\Entity\Categorie
     */
    public function getProjet()
    {
        return $this->Projet;
    }

    public function setMotCles($motCles)
    {
        foreach ($motCles as $motcle) {
            $motcle->addMotCle($this);
        }

        $this->MotCles = $motCles;
    }

    public function addMotCle(MotCle $motcle)
    {
        if (!$this->MotCles->contains($motcle)) {
            $this->MotCles->add($motcle);
        }
    }

    public function removeMotcle(MotCle $motcle)
    {
        if ($this->MotCles->contains($motcle)) {
            $this->MotCles->removeElement($motcle);
        }
    }

    /**
     * 
     * @return \AndroidDev\SiteBundle\Entity\MotCle[]
     */
    public function getMotCles()
    {
        return $this->MotCles;
    }

    public function getFeedItemDescription()
    {
        return $this->getSousTitre();
    }

    public function getFeedItemLink()
    {
        return 'http://www.android-dev.fr/' . $this->slug;
    }

    public function getFeedItemPubDate()
    {
        return $this->getPublishedAt();
    }

    public function getFeedItemTitle()
    {
        return $this->getTitre();
    }

    public function getPrevArticle()
    {
        if ($this->getProjet() != null) {
            $part = $this->getProjet()->getPrevPart();

            if (!empty($part)) {
                return $part->getArticle();
            }
        }
        return null;
    }

    public function getNextArticle()
    {
        if ($this->getProjet() != null) {
            $part = $this->getProjet()->getNextPart();

            if (!empty($part)) {
                return $part->getArticle();
            }
        }
        return null;
    }

    public function getPublishedAt()
    {
        if (empty($this->publishedAt)) {
            return $this->getCreated();
        } else {
            return $this->publishedAt;
        }
    }

    public function setPublishedAt($publishedAt)
    {
        $this->publishedAt = $publishedAt;
    }

}
