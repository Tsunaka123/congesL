<?php

namespace App\Entity;

use App\Repository\DelegationRepository;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass: DelegationRepository::class)]
class Delegation
{

    #[ORM\Column]
    #[ORM\Id]
    private ?int $idUserDelegue = null;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity:Utilisateur::class, inversedBy: "delegations")]
    #[ORM\JoinColumn(nullable:true)]
    private Utilisateur $idUserDelegant;


    public function __construct()
    {
    }

    public function getIdUserDelegue(): ?int
    {
        return $this->idUserDelegue;
    }

    public function setIdUserDelegue(int $idUserDelegue): self
    {
        $this->idUserDelegue = $idUserDelegue;

        return $this;
    }

    public function getIdUserDelegant(): ?Utilisateur
    {
        return $this->idUserDelegant;
    }

    public function setIdUserDelegant(?Utilisateur $idUserDelegant): self
    {
        $this->idUserDelegant = $idUserDelegant;

        return $this;
    }






}
