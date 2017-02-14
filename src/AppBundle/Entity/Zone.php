<?php

namespace AppBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * Zone
 *
 * @ORM\Table(name="zone")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ZoneRepository")
 * @Gedmo\Loggable
 */
class Zone
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
     * @Gedmo\Versioned
     * @ORM\Column(name="libelle", type="string", length=25)
     */
    private $libelle;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=2, nullable=true)
     */
    private $code;

    /**
     * @var string
     *
     * @Gedmo\Slug(fields={"libelle"})
     * @ORM\Column(name="slug", type="string", length=255, nullable=true)
     */
    private $slug;

    /**
     * @var bool
     *
     * @ORM\Column(name="desactivation", type="boolean", nullable=true)
     */
    private $desactivation;

    /**
     * @var string
     *
     * @Gedmo\Blameable(on="create")
     * @ORM\Column(name="publie_par", type="string", length=25, nullable=true)
     */
    private $publiePar;

    /**
     * @var string
     *
     * @Gedmo\Blameable(on="update")
     * @ORM\Column(name="modifie_par", type="string", length=25, nullable=true)
     */
    private $modifiePar;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="publie_le", type="datetimetz", nullable=true)
     */
    private $publieLe;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="modifie_le", type="datetimetz", nullable=true)
     */
    private $modifieLe;

    // Gestion de la relation avec beneficiaire
    /**
    * @ORM\OneToMany(targetEntity="AppBundle\Entity\Beneficiaire", mappedBy="zone")
    */
    private $beneficiaires;


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
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Zone
     */
    public function setLibelle($libelle)
    {
        $this->libelle = strtoupper($libelle);

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set code
     *
     * @param string $code
     *
     * @return Zone
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Zone
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

    /**
     * Set desactivation
     *
     * @param boolean $desactivation
     *
     * @return Zone
     */
    public function setDesactivation($desactivation)
    {
        $this->desactivation = $desactivation;

        return $this;
    }

    /**
     * Get desactivation
     *
     * @return bool
     */
    public function getDesactivation()
    {
        return $this->desactivation;
    }

    /**
     * Set publiePar
     *
     * @param string $publiePar
     *
     * @return Zone
     */
    public function setPubliePar($publiePar)
    {
        $this->publiePar = $publiePar;

        return $this;
    }

    /**
     * Get publiePar
     *
     * @return string
     */
    public function getPubliePar()
    {
        return $this->publiePar;
    }

    /**
     * Set modifiePar
     *
     * @param string $modifiePar
     *
     * @return Zone
     */
    public function setModifiePar($modifiePar)
    {
        $this->modifiePar = $modifiePar;

        return $this;
    }

    /**
     * Get modifiePar
     *
     * @return string
     */
    public function getModifiePar()
    {
        return $this->modifiePar;
    }

    /**
     * Set publieLe
     *
     * @param \DateTime $publieLe
     *
     * @return Zone
     */
    public function setPublieLe($publieLe)
    {
        $this->publieLe = $publieLe;

        return $this;
    }

    /**
     * Get publieLe
     *
     * @return \DateTime
     */
    public function getPublieLe()
    {
        return $this->publieLe;
    }

    /**
     * Set modifieLe
     *
     * @param \DateTime $modifieLe
     *
     * @return Zone
     */
    public function setModifieLe($modifieLe)
    {
        $this->modifieLe = $modifieLe;

        return $this;
    }

    /**
     * Get modifieLe
     *
     * @return \DateTime
     */
    public function getModifieLe()
    {
        return $this->modifieLe;
    }

    public function __toString() {
        return $this->getLibelle();
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->beneficiaires = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add beneficiaire
     *
     * @param \AppBundle\Entity\Beneficiaire $beneficiaire
     *
     * @return Zone
     */
    public function addBeneficiaire(\AppBundle\Entity\Beneficiaire $beneficiaire)
    {
        $this->beneficiaires[] = $beneficiaire;

        return $this;
    }

    /**
     * Remove beneficiaire
     *
     * @param \AppBundle\Entity\Beneficiaire $beneficiaire
     */
    public function removeBeneficiaire(\AppBundle\Entity\Beneficiaire $beneficiaire)
    {
        $this->beneficiaires->removeElement($beneficiaire);
    }

    /**
     * Get beneficiaires
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBeneficiaires()
    {
        return $this->beneficiaires;
    }
}
