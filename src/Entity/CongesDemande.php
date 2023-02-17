<?php

namespace App\Entity;

use App\Repository\CongesDemandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Cache\Adapter\ArrayAdapter;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


#[ORM\Table(name: 'CongesDemande')]
#[ORM\Entity(repositoryClass: CongesDemandeRepository::class)]

class CongesDemande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100, nullable:true)]
    #[Assert\Length(max: 100)]
    private ?string $typeDeConges= null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateDebut = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateFin = null;

    #[ORM\Column(nullable:true)]
    private ?string $informationsComplementaire = null;

    #[ORM\Column]
    private ?int $idBeneficiaire = null;

    #[ORM\Column]
    private ?string $nomPrenomBeneficiaire = null;

    #[ORM\Column]
    private ?int $idPoseur = null;

    #[ORM\Column]
    private ?string $nomPrenomPoseur = null;

    #[ORM\OneToOne(inversedBy: "congesdemande", targetEntity: User::class)]
    private $user;

    private int $listDelegationFromForm;

    private ?bool $delegationBoolFromForm = null;


    #[ORM\Column(nullable: true)]
    private string $statut = "Demandé";


        public function __construct()
    {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeDeConges(): ?string
    {
        return $this->typeDeConges;
    }

    public function setTypeDeConges(string $typeDeConges): self
    {
        $this->typeDeConges = $typeDeConges;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getInformationsComplementaire(): ?string
    {
        return $this->informationsComplementaire;
    }

    public function setInformationsComplementaire(string $informationsComplementaire): self
    {
        $this->informationsComplementaire = $informationsComplementaire;

        return $this;
    }

    public function getIdBeneficiaire(): ?int
    {
        return $this->idBeneficiaire;
    }

    public function setIdBeneficiaire(int $idBeneficiaire): self
    {
        $this->idBeneficiaire = $idBeneficiaire;

        return $this;
    }

    public function getNomPrenomBeneficiaire(): ?string
    {
        return $this->nomPrenomBeneficiaire;
    }

    public function setNomPrenomBeneficiaire(string $nomPrenomBeneficiaire): self
    {
        $this->nomPrenomBeneficiaire = $nomPrenomBeneficiaire;

        return $this;
    }

    public function getIdPoseur(): ?int
    {
        return $this->idPoseur;
    }


    public function setIdPoseur(int $idPoseur): self
    {
        $this->idPoseur = $idPoseur;

        return $this;
    }

    public function getNomPrenomPoseur(): ?string
    {
        return $this->nomPrenomPoseur;
    }

    public function setNomPrenomPoseur(string $nomPrenomPoseur): self
    {
        $this->nomPrenomPoseur = $nomPrenomPoseur;

        return $this;
    }


    public function getListDelegationFromForm(): int
    {
        return $this->listDelegationFromForm;
    }

    public function setListDelegationFromForm(int $listDelegationFromForm): void
    {
        $this->listDelegationFromForm = $listDelegationFromForm;
    }

    public function isDelegationBoolFromForm(): ?bool
    {
        return $this->delegationBoolFromForm;
    }

    public function setDelegationBoolFromForm(?bool $delegationBoolFromForm): self
    {
        $this->delegationBoolFromForm = $delegationBoolFromForm;

        return $this;
    }

    public function getStatut(): string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

}