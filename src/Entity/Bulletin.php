<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;



/**
 * @ORM\Entity(repositoryClass="App\Repository\BulletinRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Bulletin
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
     * @ORM\Column(type="text")
     */

    private $descriptionAr;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titreEn;

    /**
     * @Gedmo\Slug(fields={"titreAr"})
     * @ORM\Column(name="slug_ar", type="string", length=180, unique=true)
     */

    private $slugAr;
    /**
     * @Gedmo\Slug(fields={"titreEn"})
     * @ORM\Column(name="slug_en", type="string", length=180, unique=true)
     */
    private $slugEn;


    /**
     * @ORM\Column(type="text")
     */
    private $descriptionEn;

    /**
     * @ORM\Column(type="boolean")
     */
    private $publier;

    /**
     * @ORM\Column(name="extension", type="string", length=4)
     */
    private $extension;

    /**
     * @ORM\Column(name="nom", type="string", length=180)
     */
    private $nom;

    /**
     * @Assert\File(
     *     mimeTypes = {"application/pdf", "application/x-pdf"},
     *     mimeTypesMessage = "Please upload a valid PDF",
     * )
     */
    public $file;

    private $tempFilename;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPublier(): ?bool
    {
        return $this->publier;
    }

    public function setPublier(bool $publier): self
    {
        $this->publier = $publier;

        return $this;
    }

    public function getDateAt(): ?\DateTimeInterface
    {
        return $this->dateAt;
    }

    public function setDateAt(\DateTimeInterface $dateAt): self
    {
        $this->dateAt = $dateAt;

        return $this;
    }

    public function getExtension(): ?string
    {
        return $this->extension;
    }

    public function setExtension(string $extension): self
    {
        $this->extension = $extension;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

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
        return 'uploads/bulletins';
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

    public function getTitreAr(): ?string
    {
        return $this->titreAr;
    }

    public function setTitreAr(string $titreAr): self
    {
        $this->titreAr = $titreAr;

        return $this;
    }

    public function getDescriptionAr(): ?string
    {
        return $this->descriptionAr;
    }

    public function setDescriptionAr(string $descriptionAr): self
    {
        $this->descriptionAr = $descriptionAr;

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

    public function getDescriptionEn(): ?string
    {
        return $this->descriptionEn;
    }

    public function setDescriptionEn(string $descriptionEn): self
    {
        $this->descriptionEn = $descriptionEn;

        return $this;
    }

    public function getSlugAr(): ?string
    {
        return $this->slugAr;
    }

    public function setSlugAr(string $slugAr): self
    {
        $this->slugAr = $slugAr;

        return $this;
    }

    public function getSlugEn(): ?string
    {
        return $this->slugEn;
    }

    public function setSlugEn(string $slugEn): self
    {
        $this->slugEn = $slugEn;

        return $this;
    }


}
