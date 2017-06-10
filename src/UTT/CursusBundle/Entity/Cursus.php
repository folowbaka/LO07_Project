<?php

namespace UTT\CursusBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use UTT\EtuBundle\Entity\Etudiant;

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
     * @ORM\Column(name="label", type="string", length=255, unique=true)
     */
    private $label;

    /**
     * @var ArrayCollection
     * 
     * @ORM\OneToMany(targetEntity="UTT\CursusBundle\Entity\Element", mappedBy="cursus",cascade={"persist"})
     */
    private $elements;

    /**
     * @ORM\ManyToOne(targetEntity="UTT\EtuBundle\Entity\Etudiant", inversedBy="cursus")
     * @ORM\JoinColumn(referencedColumnName="idetudiant",nullable=false)
     */
    private $etudiant;

    /**
     * Cursus constructor.
     */
    public function __construct()
    {
        $this->elements=new ArrayCollection();
    }
    public function addElement(Element $elements)
    {
        // Ici, on utilise l'ArrayCollection vraiment comme un tableau
        $this->elements[] = $elements;
        $elements->setCursus($this);
    }

    public function removeElement(Element $elements)
    {
        $this->elements->removeElement($elements);
    }

    public function getElements()
    {
        return $this->elements;
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
     * Set label
     *
     * @param string $label
     *
     * @return Cursus
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Get label
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Get etudiant
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEtudiant()
    {
        return $this->etudiant;
    }

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
}
