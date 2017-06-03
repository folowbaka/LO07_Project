<?php

namespace UTT\CursusBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Element
 *
 * @ORM\Table(name="element")
 * @ORM\Entity(repositoryClass="UTT\CursusBundle\Repository\ElementRepository")
 */
class Element
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
     * @var int
     *
     * @ORM\Column(name="sem_seq", type="integer")
     */
    private $semSeq;

    /**
     *
     * @ORM\ManyToOne(targetEntity="UTT\CursusBundle\Entity\SemLabel")
     * @ORM\JoinColumn(nullable=false)
     */
    private $semLabel;

    /**
     * @var string
     *
     * @ORM\Column(name="sigle",type="string",length=255)
     */
    private $sigle;

    /**
     * @ORM\ManyToOne(targetEntity="UTT\CursusBundle\Entity\Categorie")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categorie;

    /**
     * @ORM\ManyToOne(targetEntity="UTT\CursusBundle\Entity\Affectation")
     * @ORM\JoinColumn(nullable=false)
     */
    private $affectation;

    /**
     * @var bool
     *
     * @ORM\Column(name="utt", type="boolean")
     */
    private $utt;

    /**
     * @var bool
     *
     * @ORM\Column(name="profil", type="boolean", length=255)
     */
    private $profil;


    /**
     * @var int
     *
     * @ORM\Column(name="credit", type="integer")
     */
    private $credit;

    /**
     * @var string
     *
     * @ORM\Column(name="resulat", type="string", length=255)
     */
    private $resultat;
        
    /**
     * @ORM\ManyToOne(targetEntity="UTT\CursusBundle\Entity\Cursus",inversedBy="elements")
     * @ORM\JoinColumn(nullable=false)
     */
    private $cursus;
    
    /**
     * Set cursus
     *
     * @param \UTT\CursusBundle\Entity\Cursus $cursus
     *
     * @return Element
     */
    public function setCursus(\UTT\CursusBundle\Entity\Cursus $cursus)
    {
        $this->cursus = $cursus;

        return $this;
    }

    /**
     * Get cursus
     *
     * @return \UTT\CursusBundle\Entity\Cursus
     */
    public function getCursus()
    {
        return $this->cursus;
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
     * Set semSeq
     *
     * @param integer $semSeq
     *
     * @return Element
     */
    public function setSemSeq($semSeq)
    {
        $this->semSeq = $semSeq;

        return $this;
    }

    /**
     * Get semSeq
     *
     * @return int
     */
    public function getSemSeq()
    {
        return $this->semSeq;
    }


    /**
     * Set utt
     *
     * @param boolean $utt
     *
     * @return Element
     */
    public function setUtt($utt)
    {
        $this->utt = $utt;

        return $this;
    }

    /**
     * Get utt
     *
     * @return bool
     */
    public function getUtt()
    {
        return $this->utt;
    }

    /**
     * Set profil
     *
     * @param string $profil
     *
     * @return Element
     */
    public function setProfil($profil)
    {
        $this->profil = $profil;

        return $this;
    }

    /**
     * Get profil
     *
     * @return string
     */
    public function getProfil()
    {
        return $this->profil;
    }

    /**
     * Set affectation
     *
     * @param string $affectation
     *
     * @return Element
     */
    public function setAffectation($affectation)
    {
        $this->affectation = $affectation;

        return $this;
    }

    /**
     * Get affectation
     *
     * @return string
     */
    public function getAffectation()
    {
        return $this->affectation;
    }

    /**
     * Set credit
     *
     * @param integer $credit
     *
     * @return Element
     */
    public function setCredit($credit)
    {
        $this->credit = $credit;

        return $this;
    }

    /**
     * Get credit
     *
     * @return int
     */
    public function getCredit()
    {
        return $this->credit;
    }
    
    /**
     * Set sigle
     *
     * @param string $sigle
     *
     * @return Element
     */
    public function setSigle($sigle)
    {
        $this->sigle = $sigle;

        return $this;
    }

    /**
     * Get sigle
     *
     * @return string
     */
    public function getSigle()
    {
        return $this->sigle;
    }

    /**
     * Set categorie
     *
     * @param \UTT\CursusBundle\Entity\Categorie $categorie
     *
     * @return Element
     */
    public function setCategorie(\UTT\CursusBundle\Entity\Categorie $categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return \UTT\CursusBundle\Entity\Categorie
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Set resultat
     *
     * @param string $resultat
     *
     * @return Element
     */
    public function setResultat($resultat)
    {
        $this->resultat = $resultat;

        return $this;
    }

    /**
     * Get resultat
     *
     * @return string
     */
    public function getResultat()
    {
        return $this->resultat;
    }

    /**
     * Set semLabel
     *
     * @param \UTT\CursusBundle\Entity\SemLabel $semLabel
     *
     * @return Element
     */
    public function setSemLabel(\UTT\CursusBundle\Entity\SemLabel $semLabel)
    {
        $this->semLabel = $semLabel;

        return $this;
    }

    /**
     * Get semLabel
     *
     * @return \UTT\CursusBundle\Entity\SemLabel
     */
    public function getSemLabel()
    {
        return $this->semLabel;
    }
}
