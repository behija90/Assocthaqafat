<?php

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;




/**
 * @ORM\Entity(repositoryClass="App\Repository\FileRepository")
 * @ORM\HasLifecycleCallbacks
 */
class File
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titreAr;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titreEn;

    /**
     * @ORM\Column(name="extension_image", type="string", length=180, nullable=true)
     */
    private $extension;

    /**
     * @ORM\Column(name="nom", type="string", length=180, nullable=true)
     */
    private $nom;

    /**
     * @ORM\Column(name="type", type="string", length=10)
     */
    private $typeFile;


    /**
     * @Assert\File()
     */
    public $file;

    private $tempFilename;


    public function __construct()
    {

    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitreAr(): ?string
    {
        return $this->titreAr;
    }

    public function setTitreAr(string $titreAr): self
    {
        $this->titreAr = $titreAr;

        return $this;
    }

    public function getTitreEn(): ?string
    {
        return $this->titreEn;
    }

    public function setTitreEn(string $titreEn): self
    {
        $this->titreEn = $titreEn;

        return $this;
    }

    public function getExtension(): ?string
    {
        return $this->extension;
    }

    public function setExtension(?string $extension): self
    {
        $this->extension = $extension;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getTypeFile(): ?string
    {
        return $this->typeFile;
    }

    public function setTypeFile(string $typeFile): self
    {
        $this->typeFile = $typeFile;

        return $this;
    }

    public function setFile(UploadedFile $file)
    {
        $this->file = $file;

        if (null !== $this->extension) {
            $this->tempFilename = $this->nom;

            $this->extension = null;
            $this->nom = null;
        }
    }

    public function getFile()
    {
        return $this->file;
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (null === $this->file) {
            return;
        }

        $this->extension = $this->file->guessExtension();
        // genere un nom unique pour l'image.
        $this->nom = md5(uniqid('', true)) . '.' . $this->extension;
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if (null === $this->file) {
            return;
        }

        if (null !== $this->tempFilename) {
            $oldFile = $this->getUploadRootDir() . '/' . $this->tempFilename;

            if (file_exists($oldFile)) {
                unlink($oldFile);
            }
        }

        $this->file->move($this->getUploadRootDir(), $this->nom);
    }

    /**
     * @ORM\PreRemove()
     */
    public function preRemoveUpload()
    {
        $this->tempFilename = $this->getUploadRootDir() . '/' . $this->nom;
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if (file_exists($this->tempFilename)) {
            unlink($this->tempFilename);
        }
    }

    //folder
    public function getUploadDir()
    {
        return 'uploads/files';
    }

    // path to folder web
    protected function getUploadRootDir()
    {
        return __DIR__ . '/../../public/' . $this->getUploadDir();
    }

    public function getWebPath()
    {
        return $this->getUploadDir() . '/' . $this->getNom();
    }


}
