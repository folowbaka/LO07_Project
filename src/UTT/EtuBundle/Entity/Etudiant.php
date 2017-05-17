<?php

namespace UTT\EtuBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use UTT\CursusBundle\Entity\Cursus;

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
     * @ORM\ManyToOne(targetEntity="UTT\EtuBundle\Entity\Admission")
     * @ORM\JoinColumn(nullable=false)
     */
    private $admission;

    /**
     * @ORM\ManyToOne(targetEntity="UTT\EtuBundle\Entity\Filliere")
     * @ORM\JoinColumn(nullable=false)
     */
    private $filliere;

    /**
     * @ORM\OneToMany(targetEntity="UTT\CursusBundle\Entity\Cursus", mappedBy="etudiant")
     */
    private $cursus;

    /**
     * Etudiant constructor.
     */
    public function __construct()
    {
        $this->cursus=new ArrayCollection();
    }

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
        return $this;
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


    /**
     * Set admission
     *
     * @param \UTT\EtuBundle\Entity\Admission $admission
     *
     * @return Etudiant
     */
    public function setAdmission(\UTT\EtuBundle\Entity\Admission $admission)
    {
        $this->admission = $admission;

        return $this;
    }

    /**
     * Get admission
     *
     * @return \UTT\EtuBundle\Entity\Admission
     */
    public function getAdmission()
    {
        return $this->admission;
    }

    /**
     * Set filliere
     *
     * @param \UTT\EtuBundle\Entity\Filliere $filliere
     *
     * @return Etudiant
     */
    public function setFilliere(\UTT\EtuBundle\Entity\Filliere $filliere)
    {
        $this->filliere = $filliere;

        return $this;
    }

    /**
     * Get filliere
     *
     * @return \UTT\EtuBundle\Entity\Filliere
     */
    public function getFilliere()
    {
        return $this->filliere;
    }

    public function addCursus(Cursus $cursus)
    {
        $this->cursus[] = $cursus;
    }

    public function removeCursus(Cursus $cursus)
    {
        $this->cursus->removeElement($cursus);
    }

    public function getCursus()
    {
        return $this->applications;
    }

}
