<?php
// src/AndroidDev/UserBundle/Entity/User.php
 
namespace AndroidDev\UserBundle\Entity;
 
use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
 
/**
 * @ORM\Entity
 * @ORM\Table(name="Auteur")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     */
    private $mail;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     */
    private $pseudo;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     */
    private $lienProfil;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     */
    private $presentation;
    
    

    /**
     * Get nom
     *
     * @return integer 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return Article
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return integer 
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return Article
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return integer 
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return Article
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get nom
     *
     * @return integer 
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return Article
     */
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    /**
     * Get nom
     *
     * @return integer 
     */
    public function getLienProfil()
    {
        return $this->lienProfil;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return Article
     */
    public function setLienProfil($lienProfil)
    {
        $this->lienProfil = $lienProfil;

        return $this;
    }

    /**
     * Get nom
     *
     * @return integer 
     */
    public function getPresentation()
    {
        return $this->presentation;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return Article
     */
    public function setPresentation($presentation)
    {
        $this->presentation = $presentation;

        return $this;
    }
}