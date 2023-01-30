<?php

namespace App\Entity;

use App\Repository\FerieRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FerieRepository::class)]
class Ferie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateF = null;

    #[ORM\Column(length: 50)]
    private ?string $libelleF = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateF(): ?\DateTimeInterface
    {
        return $this->dateF;
    }

    public function setDateF(\DateTimeInterface $dateF): self
    {
        $this->dateF = $dateF;

        return $this;
    }

    public function getLibelleF(): ?string
    {
        return $this->libelleF;
    }

    public function setLibelleF(string $libelleF): self
    {
        $this->libelleF = $libelleF;

        return $this;
    }
}
