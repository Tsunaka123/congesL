<?php

namespace App\Entity;

use App\Repository\EtatCongesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EtatCongesRepository::class)]
class EtatConges
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $libEtatConges = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibEtatConges(): ?string
    {
        return $this->libEtatConges;
    }

    public function setLibEtatConges(string $libEtatConges): self
    {
        $this->libEtatConges = $libEtatConges;

        return $this;
    }
}
