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
    #[ORM\ManyToOne(targetEntity:User::class, inversedBy: "delegations")]
    #[ORM\JoinColumn(nullable:true)]
    private User $idUserDelegant;


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

    public function getIdUserDelegant(): ?User
    {
        return $this->idUserDelegant;
    }

    public function setIdUserDelegant(?User $idUserDelegant): self
    {
        $this->idUserDelegant = $idUserDelegant;

        return $this;
    }






}
