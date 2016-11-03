<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Article
 *
 * @ORM\Table(name="article")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ArticleRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Article
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
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="resume", type="text", nullable=true)
     */
    private $resume;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="text")
     */
    private $contenu;

    /**
     * @var string
     *
     * @ORM\Column(name="tags", type="text", nullable=true)
     */
    private $tags;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="publicationAt", type="datetime", nullable=true)
     */
    private $publicationAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="modificationAt", type="datetime", nullable=true)
     */
    private $modificationAt;

    /**
     * @var bool
     *
     * @ORM\Column(name="statut", type="boolean", nullable=true)
     */
    private $statut;


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
     * Set titre
     *
     * @param string $titre
     *
     * @return Article
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set resume
     *
     * @param string $resume
     *
     * @return Article
     */
    public function setResume($resume)
    {
        $this->resume = $resume;

        return $this;
    }

    /**
     * Get resume
     *
     * @return string
     */
    public function getResume()
    {
        return $this->resume;
    }

    /**
     * Set contenu
     *
     * @param string $contenu
     *
     * @return Article
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get contenu
     *
     * @return string
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * Set tags
     *
     * @param string $tags
     *
     * @return Article
     */
    public function setTags($tags)
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * Get tags
     *
     * @return string
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Set publicationAt
     *
     * @param \DateTime $publicationAt
     *
     * @return Article
     */
    public function setPublicationAt($publicationAt)
    {
        $this->publicationAt = $publicationAt;

        return $this;
    }

    /**
     * Get publicationAt
     *
     * @return \DateTime
     */
    public function getPublicationAt()
    {
        return $this->publicationAt;
    }

    /**
     * Set modificationAt
     *
     * @param \DateTime $modificationAt
     *
     * @return Article
     */
    public function setModificationAt($modificationAt)
    {
        $this->modificationAt = $modificationAt;

        return $this;
    }

    /**
     * Get modificationAt
     *
     * @return \DateTime
     */
    public function getModificationAt()
    {
        return $this->modificationAt;
    }

    /**
     * Set statut
     *
     * @param boolean $statut
     *
     * @return Article
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get statut
     *
     * @return bool
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
    * @ORM\PrePersist
    */
    public function setPublicationAtValue()
    {
       $this->publicationAt = new \DateTime();
    }

    /**
    * @ORM\PreUpdate
    */
    public function setModificationAtValue()
    {
       $this->modificationAt = new \DateTime();
    }

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Rubrique")
     * @ORM\JoinTable(name="articles_rubriques",
     *      joinColumns={@ORM\JoinColumn(name="article_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="rubrique_id", referencedColumnName="id")}
     *      )
     */
     private $rubriques;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->rubriques = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add rubrique
     *
     * @param \AppBundle\Entity\Rubrique $rubrique
     *
     * @return Article
     */
    public function addRubrique(\AppBundle\Entity\Rubrique $rubrique)
    {
        $this->rubriques[] = $rubrique;

        return $this;
    }

    /**
     * Remove rubrique
     *
     * @param \AppBundle\Entity\Rubrique $rubrique
     */
    public function removeRubrique(\AppBundle\Entity\Rubrique $rubrique)
    {
        $this->rubriques->removeElement($rubrique);
    }

    /**
     * Get rubriques
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRubriques()
    {
        return $this->rubriques;
    }


    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Image", cascade={"persist", "remove"})
     */
     private $image;


    /**
     * Set image
     *
     * @param \AppBundle\Entity\Image $image
     *
     * @return Article
     */
    public function setImage(\AppBundle\Entity\Image $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \AppBundle\Entity\Image
     */
    public function getImage()
    {
        return $this->image;
    }
}
