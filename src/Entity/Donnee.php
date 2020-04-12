<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DonneeRepository")
 */
class Donnee
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
    private $contenuAr;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titreEn;

    /**
     * @ORM\Column(type="text")
     */
    private $contenuEn;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="boolean")
     */
    private $publier;

    public function getId(): ?int
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

    public function getContenuAr(): ?string
    {
        return $this->contenuAr;
    }

    public function setContenuAr(string $contenuAr): self
    {
        $this->contenuAr = $contenuAr;

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

    public function getContenuEn(): ?string
    {
        return $this->contenuEn;
    }

    public function setContenuEn(string $contenuEn): self
    {
        $this->contenuEn = $contenuEn;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
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
}
