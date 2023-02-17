<?php

namespace App\Entity;

use App\Repository\DelegationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'Delegation')]
#[ORM\Entity(repositoryClass: DelegationRepository::class)]
class Delegation
{

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity:User::class, inversedBy: "delegationsIdUserDelegue")]
    #[ORM\JoinColumn(nullable:true)]
    private User $idUserDelegue;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity:User::class, inversedBy: "delegationsIdUserDelegant")]
    #[ORM\JoinColumn(nullable:true)]
    private User $idUserDelegant;


    public function __construct()
    {
    }

    public function getIdUserDelegue(): ?User
    {
        return $this->idUserDelegue;
    }

    public function setIdUserDelegue(?user $idUserDelegue): self
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
