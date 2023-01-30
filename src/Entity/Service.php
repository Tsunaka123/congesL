<?php

namespace App\Entity;

use App\Repository\ServiceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ServiceRepository::class)]
class Service
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $idService = null;

    #[ORM\Column(length: 100)]
    private ?string $libService = null;

    #[ORM\Column]
    private ?bool $preferenceMail = null;

    #[ORM\Column]
    private ?bool $preferenceValidation = null;

    #[ORM\Column]
    private ?int $idDirecteur = null;

    #[ORM\Column]
    private ?int $idAdmin = null;

    #[ORM\Column]
    private ?int $anneeCourante = null;

    public function getId(): ?int
    {
        return $this->idService;
    }

    public function getLibService(): ?string
    {
        return $this->libService;
    }

    public function setLibService(string $libService): self
    {
        $this->libService = $libService;

        return $this;
    }

    public function isPreferenceMail(): ?bool
    {
        return $this->preferenceMail;
    }

    public function setPreferenceMail(bool $preferenceMail): self
    {
        $this->preferenceMail = $preferenceMail;

        return $this;
    }

    public function isPreferenceValidation(): ?bool
    {
        return $this->preferenceValidation;
    }

    public function setPreferenceValidation(bool $preferenceValidation): self
    {
        $this->preferenceValidation = $preferenceValidation;

        return $this;
    }

    public function getIdDirecteur(): ?int
    {
        return $this->idDirecteur;
    }

    public function setIdDirecteur(int $idDirecteur): self
    {
        $this->idDirecteur = $idDirecteur;

        return $this;
    }

    public function getIdAdmin(): ?int
    {
        return $this->idAdmin;
    }

    public function setIdAdmin(int $idAdmin): self
    {
        $this->idAdmin = $idAdmin;

        return $this;
    }

    public function getAnneeCourante(): ?int
    {
        return $this->anneeCourante;
    }

    public function setAnneeCourante(int $anneeCourante): self
    {
        $this->anneeCourante = $anneeCourante;

        return $this;
    }
}
