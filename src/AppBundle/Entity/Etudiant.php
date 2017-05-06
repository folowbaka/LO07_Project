<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Etudiant
 *
 * @ORM\Table(name="etudiant")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EtudiantRepository")
 */
class Etudiant
{
    /**
     * @var int
     *
     * @ORM\Column(name="num", type="integer")
     * @ORM\Id
     *
     */
    private $num;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255)
     */
    private $prenom;
    
    /**
     * @var string
     *
     * @ORM\Column(name="admission", type="string", length=255)
     */
    private $admission;
    
    /**
     * @var string
     *
     * @ORM\Column(name="filliere", type="string", length=255)
     */
    private $filliere;

    /**
     * Set num
     *
     * @param integer $num
     * @return Etudiant
     */
    public function setNum($num)
    {
        $this->num = $num;

        return $this;
    }
    

    /**
     * Get Num
     *
     * @return integer
     */
    public function getNum()
    {
        return $this->num;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return Etudiant
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
     * @return Etudiant
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
     * Set admission
     *
     * @param string $admission
     * @return Etudiant
     */
    public function setAdmission($admission)
    {
        $this->admission = $admission;

        return $this;
    }

    /**
     * Get admission
     *
     * @return string
     */
    public function getAdmission()
    {
        return $this->admission;
    }
    
    /**
     * Set filliere
     *
     * @param string $filliere
     * @return Etudiant
     */
    public function setFilliere($filliere)
    {
        $this->filliere = $filliere;

        return $this;
    }

    /**
     * Get filliere
     *
     * @return string
     */
    public function getFilliere()
    {
        return $this->filliere;
    }
    
    

    public function __construct() {
        $this->nom="";
        $this->prenom="";
        $this->admission="";
        $this->filliere ="";
    }

}
