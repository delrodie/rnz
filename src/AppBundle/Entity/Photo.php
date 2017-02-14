<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Photo
 *
 * @ORM\Table(name="photo")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PhotoRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Photo
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
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="alt", type="string", length=255, nullable=true)
     */
    private $alt;


        /**
         * Get id
         *
         * @return int
         */
        public function getId()
        {
            return $this->id;
        }

        private $file;

        private $tempFileName;

        public function getFile()
        {
          return $this->file;
        }

        public function setFile(UploadedFile $file = null)
        {
          $this->file = $file;
          //die('position');
          // Verification de l'existence d'un fichier pour cette entité
          if (null !== $this->url) {
              $this->tempFileName = $this->url;

              //Réinitialisation des attributs alt et url
              $this->url = null;
              $this->alt = null;
          }
        }

        /**
        * @ORM\PrePersist()
        * @ORM\PreUpdate()
        */
        public function preUpload()
        {
          // S'il n'y a pas de fichier retourner le lien de l'avatar
          if (null === $this->file) {
            return;
          }


          // Affectation de l'extension du fichier à l'url
          $this->url = $this->file->guessExtension();

          // Affectation du nom du fichier
          $this->alt = $this->file->getClientOriginalName();
        }

        /**
        * @ORM\PostPersist()
        * @ORM\PostUpdate()
        */
        public function upload()
        {
          // S'il n'y a pas de fichier
          if (null === $this->file ) {
            return;
          }

          // Suppression de l'ancien fichier s'il en existe
          if (null !== $this->tempFileName) {
            $oldFile = $this->getUploadRootDir().'/'.$this->id.'.'.$this->tempFileName;
            if (file_exists($oldFile)) {
              unlink($oldFile);
            }
          }

          // Deplacement du fichier dans notre repertoire
          $this->file->move(
            $this->getUploadRootDir(), // Le répertoire de destination
            $this->id.'.'.$this->url   // Le nom du fichier à créer, ici « id.extension »
          );
        }

        /**
        * @ORM\PreRemove()
        */
        public function preRemoveUpload()
        {
          // Sauvegarde temporaire du nom du fichier
          $this->tempFileName = $this->getUploadRootDir().'/'.$this->id.'.'.$this->url;
        }

        /**
        * @ORM\PostRemove()
        */
        public function removeUpload()
        {
          // En PostRemove, on n'a pas accès à l'id, on utilise notre nom sauvegardé
          if (file_exists($this->tempFilename)) {
            // On supprime le fichier
            unlink($this->tempFilename);
          }
        }

        public function getUploadDir()
        {
          // On retourne le chemin relatif vers l'image pour un navigateur
          return 'uploads';
        }

        protected function getUploadRootDir()
        {
          // On retourne le chemin relatif vers l'image pour notre code PHP
          //$racine = sudo chmod ;
          return __DIR__.'/../../../web/'.$this->getUploadDir();
        }


    /**
     * Set url
     *
     * @param string $url
     *
     * @return Photo
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set alt
     *
     * @param string $alt
     *
     * @return Photo
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;

        return $this;
    }

    /**
     * Get alt
     *
     * @return string
     */
    public function getAlt()
    {
        return $this->alt;
    }

}
