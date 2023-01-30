<?php

namespace App\Entity;

use App\Repository\CongesDemandeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: CongesDemandeRepository::class)]

class CongesDemande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    #[Assert\NotBlank]
    #[Assert\Length(min: 2, max: 100)]
    private ?string $title= null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $start = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $end = null;

    #[ORM\Column]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $id_beneficiaire = null;

    #[ORM\Column]
    private ?int $id_poseur = null;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getStart(): ?\DateTimeInterface
    {
        return $this->start;
    }

    public function setStart(\DateTimeInterface $start): self
    {
        $this->start = $start;

        return $this;
    }

    public function getEnd(): ?\DateTimeInterface
    {
        return $this->end;
    }

    public function setEnd(\DateTimeInterface $end): self
    {
        $this->end = $end;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getIdBeneficiaire(): ?int
    {
        return $this->id_beneficiaire;
    }

    public function getIdPoseur(): ?int
    {
        return $this->id_poseur;
    }

    public function setIBeneficiaire(int $id_beneficiaire): self
    {
        $this->id_beneficiaire = $id_beneficiaire;

        return $this;
    }


    public function setIdPoseur(int $id_poseur): self
    {
        $this->id_poseur = $id_poseur;

        return $this;
    }

    public function setIdBeneficiaire(int $id_beneficiaire): self
    {
        $this->id_beneficiaire = $id_beneficiaire;

        return $this;
    }

}