<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AffiliationRepository")
 * @UniqueEntity(fields={"email"}, message="Email exite")
 */
class Affiliation
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
    private $nomPrenom;
    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nationalite;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $dateLieuNaissance;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $numCin;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $dateLieuEmission;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $profession;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $entreprise;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $categorieAffi;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateCreation;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Image", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $image;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomPrenom(): ?string
    {
        return $this->nomPrenom;
    }

    public function setNomPrenom(string $nomPrenom): self
    {
        $this->nomPrenom = $nomPrenom;

        return $this;
    }

    public function getDateLieuNaissance(): ?string
    {
        return $this->dateLieuNaissance;
    }

    public function setDateLieuNaissance(string $dateLieuNaissance): self
    {
        $this->dateLieuNaissance = $dateLieuNaissance;

        return $this;
    }

    public function getNumCin(): ?string
    {
        return $this->numCin;
    }

    public function setNumCin(string $numCin): self
    {
        $this->numCin = $numCin;

        return $this;
    }

    public function getProfession(): ?string
    {
        return $this->profession;
    }

    public function setProfession(string $profession): self
    {
        $this->profession = $profession;

        return $this;
    }

    public function getEntreprise(): ?string
    {
        return $this->entreprise;
    }

    public function setEntreprise(string $entreprise): self
    {
        $this->entreprise = $entreprise;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getCategorieAffi(): ?string
    {
        return $this->categorieAffi;
    }

    public function setCategorieAffi(string $categorieAffi): self
    {
        $this->categorieAffi = $categorieAffi;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getNationalite(): ?string
    {
        return $this->nationalite;
    }

    public function setNationalite(string $nationalite): self
    {
        $this->nationalite = $nationalite;

        return $this;
    }

    public function getImage(): ?Image
    {
        return $this->image;
    }

    public function setImage(Image $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getDateLieuEmission(): ?string
    {
        return $this->dateLieuEmission;
    }

    public function setDateLieuEmission(string $dateLieuEmission): self
    {
        $this->dateLieuEmission = $dateLieuEmission;

        return $this;
    }





}
