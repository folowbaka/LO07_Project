<?php

namespace UTT\CursusBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cursus
 *
 * @ORM\Table(name="cursus")
 * @ORM\Entity(repositoryClass="UTT\CursusBundle\Repository\CursusRepository")
 */
class Cursus
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="etiquette", type="string", length=255)
     */
    private $etiquette;
    
    /**
     * @ORM\ManyToOne(targetEntity="UTT\EtuBundle\Entity\Etudiant")
     * @ORM\JoinColumn(referencedColumnName="idEtudiant")
     */
    private $etudiant;
    
    /**
     * Set etudiant
     *
     * @param \UTT\EtuBundle\Entity\Etudiant $etudiant
     *
     * @return Cursus
     */
    public function setEtudiant(\UTT\EtuBundle\Entity\Etudiant $etudiant)
    {
        $this->etudiant = $etudiant;

        return $this;
    }

    /**
     * Get etudiant
     *
     * @return \UTT\EtuBundle\Entity\Etudiant
     */
    public function getEtudiant()
    {
        return $this->etudiant;
    }


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set etiquette
     *
     * @param string $etiquette
     *
     * @return Cursus
     */
    public function setEtiquette($etiquette)
    {
        $this->etiquette = $etiquette;

        return $this;
    }

    /**
     * Get etiquette
     *
     * @return string
     */
    public function getEtiquette()
    {
        return $this->etiquette;
    }
}

