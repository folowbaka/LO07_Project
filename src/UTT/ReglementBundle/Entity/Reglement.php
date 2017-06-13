<?php

namespace UTT\ReglementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reglement
 *
 * @ORM\Table(name="reglement")
 * @ORM\Entity(repositoryClass="UTT\ReglementBundle\Repository\ReglementRepository")
 */
class Reglement
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
     * @ORM\OneToMany(targetEntity="UTT\ReglementBundle\Entity\Regle", mappedBy="reglement",cascade={"persist","remove"})
     */
    private $regles;

    public function __construct()
    {
        $this->regles=new ArrayCollection();
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
     * @return Reglement
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
    public function addRegle(Element $regles)
    {
        // Ici, on utilise l'ArrayCollection vraiment comme un tableau
        $this->regles[] = $regles;
        $regles->setReglement($this);
    }

    public function removeElement(Element $regles)
    {
        $this->elements->removeElement($regles);
    }

    public function getElements()
    {
        return $this->regles;
    }

    /**
     * Remove regle
     *
     * @param \UTT\ReglementBundle\Entity\Regle $regle
     */
    public function removeRegle(\UTT\ReglementBundle\Entity\Regle $regle)
    {
        $this->regles->removeElement($regle);
    }

    /**
     * Get regles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRegles()
    {
        return $this->regles;
    }
}
