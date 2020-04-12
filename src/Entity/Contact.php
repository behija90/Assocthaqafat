<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ContactRepository")
 */
class Contact
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=60)
     * @Assert\NotBlank(message="Nom vide.")
     * @Assert\Length(
     *     min=3,
     *     max="50",
     *     minMessage="Nom doit être au moin 3 lettres.",
     *     maxMessage="Nom est trop long (max 50 lettres)."
     *    )
     */
    private $nomPrenom;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\Email(
     *     message = " email '{{ value }}' non valide.",
     *     checkMX = true
     * )
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=20)
     * @Assert\Regex(
     *        "/^[0-9 ]+$/",
     *        message="Téléphone: utiliser seulement des nombres et espaces"
     * )
     * @Assert\Length(
     *     min=8,
     *     max=12,
     *     minMessage="Telephone est court",
     *    )
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *     min=3,
     *     max="50",
     *     minMessage="Sujet doit être au moin 3 caractéres.",
     *     maxMessage="Sujet est trop long (max 255 caractéres)."
     *    )
     * @Assert\NotBlank(message="Sujet est vide")
     */
    private $sujet;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="Email est vide")
     */
    private $message;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateMessage;

    /**
     * @ORM\Column(type="boolean")
     */
    private $vu;

    /**
     * Construct
     */
    public function __construct()
    {
        $this->dateMessage = new \Datetime();
        $this->vu = false;
    }

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

    public function getSujet(): ?string
    {
        return $this->sujet;
    }

    public function setSujet(string $sujet): self
    {
        $this->sujet = $sujet;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getDateMessage(): ?\DateTimeInterface
    {
        return $this->dateMessage;
    }

    public function setDateMessage(\DateTimeInterface $dateMessage): self
    {
        $this->dateMessage = $dateMessage;

        return $this;
    }

    public function getVu(): ?bool
    {
        return $this->vu;
    }

    public function setVu(bool $vu): self
    {
        $this->vu = $vu;

        return $this;
    }


}
