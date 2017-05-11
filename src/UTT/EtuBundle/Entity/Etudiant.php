<?php

namespace UTT\EtuBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Etudiant
 *
 * @ORM\Table(name="etudiant")
 * @ORM\Entity(repositoryClass="UTT\EtuBundle\Repository\EtudiantRepository")
 */
class Etudiant
{
    /**
     * @var string
     *
     * @ORM\Column(name="idetudiant", type="string",length=255)
     * @ORM\Id
     */
    private $idEtudiant;

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
     * Get id
     *
     * @return int
     */
    public function getIdEtudiant()
    {
        return $this->idEtudiant;
    }
    public function setIdEtudiant($idEtudiant)
    {
        $this->idEtudiant=$idEtudiant;
        return this;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
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
     *
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

}

