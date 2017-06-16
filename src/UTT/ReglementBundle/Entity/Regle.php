<?php

namespace UTT\ReglementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Regle
 *
 * @ORM\Table(name="regle")
 * @ORM\Entity(repositoryClass="UTT\ReglementBundle\Repository\RegleRepository")
 */
class Regle
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
     * @ORM\Column(name="label", type="string", length=255)
     */
    private $label;

    /**
     * @ORM\ManyToOne(targetEntity="UTT\ReglementBundle\Entity\Agregat")
     * @ORM\JoinColumn(nullable=false)
     */
    private $agregat;

    /**
     * @var string
     *
     * @ORM\Column(name="cibleAgregat", type="string", length=255,nullable=true)
     */
    private $cibleAgregat;

    /**
     * @ORM\ManyToOne(targetEntity="UTT\CursusBundle\Entity\Affectation")
     *
     */
    private $affectation;
    /**
     * @var int
     *
     * @ORM\Column(name="seuil", type="integer")
     */
    private $seuil;

    /**
     * @ORM\ManyToOne(targetEntity="UTT\ReglementBundle\Entity\Reglement",inversedBy="regles",cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $reglement;

    /**
     * Set reglement
     *
     * @param \UTT\ReglementBundle\Entity\Reglement $reglement
     *
     * @return Reglement
     */
    public function setCursus(\UTT\ReglementBundle\Entity\Reglement $reglement)
    {
        $this->reglement = $reglement;

        return $this;
    }

    /**
     * Get reglement
     *
     * @return \UTT\ReglementBundle\Entity\Reglement
     */
    public function getReglement()
    {
        return $this->reglement;
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
     * @return Regle
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
     * Set cibleAgregat
     *
     * @param string $cibleAgregat
     *
     * @return Regle
     */
    public function setCibleAgregat($cibleAgregat)
    {
        $this->cibleAgregat = $cibleAgregat;

        return $this;
    }

    /**
     * Get cibleAgregat
     *
     * @return string
     */
    public function getCibleAgregat()
    {
        return $this->cibleAgregat;
    }

    /**
     * Set seuil
     *
     * @param integer $seuil
     *
     * @return Regle
     */
    public function setSeuil($seuil)
    {
        $this->seuil = $seuil;

        return $this;
    }

    /**
     * Get seuil
     *
     * @return int
     */
    public function getSeuil()
    {
        return $this->seuil;
    }

    /**
     * @param Agregat $agregat
     */
    public function setAgregat(Agregat $agregat)
    {
        $this->agregat=$agregat;
    }

    /**
     * @return \UTT\ReglementBundle\Entity\Agregat
     */
    public function getAgregat()
    {
        return $this->agregat;
    }
    /**
     * Set affectation
     *
     * @param \UTT\CursusBundle\Entity\Affectation $affectation
     *
     * @return Reglement
     */
    public function setAffectation(\UTT\CursusBundle\Entity\Affectation $affectation)
    {
        $this->affectation = $affectation;

        return $this;
    }

    /**
     * Get affectation
     *
     * @return \UTT\CursusBundle\Entity\Affectation $affectation
     */
    public function getAffectation()
    {
        return $this->affectation;
    }

    /**
     * Set reglement
     *
     * @param \UTT\ReglementBundle\Entity\Reglement $reglement
     *
     * @return Regle
     */
    public function setReglement(\UTT\ReglementBundle\Entity\Reglement $reglement)
    {
        $this->reglement = $reglement;

        return $this;
    }
}
