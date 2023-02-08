<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\DocBlock\Tags\TagWithType;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[UniqueEntity('mailU', 'loginU')]
#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
#[UniqueEntity(fields: ['loginU'], message: 'There is already an account with this username')]

class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nomU = null;

    #[ORM\Column(length: 50)]
    private ?string $pnomU = null;

    #[ORM\Column(length: 70)]
    private ?string $loginU = null;

    #[ORM\Column(length: 150)]
    private ?string $pwdU = null;

    #[ORM\Column(length: 100)]
    private ?string $mailU = null;

    #[ORM\Column(nullable: false)]
    private array $roles = [];

    #[ORM\Column(nullable: true)]
    private array $idServiceU;

    private Collection $idServiceFromForm;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $commentaireU = null;

    #[ORM\OneToMany(targetEntity: Delegation::class, mappedBy: "idUserDelegant")]
    private Collection $delegations;


    public function eraseCredentials()
    {
    }

    public function __construct()
    {
        $this->delegations = new ArrayCollection();
        $this->idServiceFromForm = new ArrayCollection();

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserIdentifier(): string
    {
        return (string)$this->loginU;
    }
    public function getNomU(): ?string
    {
        return $this->nomU;
    }

    public function setNomU(string $nomU): self
    {
        $this->nomU = $nomU;

        return $this;
    }

    public function getPnomU(): ?string
    {
        return $this->pnomU;
    }

    public function setPnomU(string $pnomU): self
    {
        $this->pnomU = $pnomU;

        return $this;
    }

    public function getLoginU(): ?string
    {
        return $this->loginU;
    }

    public function setLoginU(string $loginU): self
    {
        $this->loginU = $loginU;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->pwdU;

    }

    public function setPassword(string $pwdU): self
    {
        $this->pwdU = $pwdU;

        return $this;
    }

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    public function setPlainPassword(?string $plainPassword): void
    {
        $this->plainPassword = $plainPassword;
    }

    public function getMailU(): ?string
    {
        return $this->mailU;
    }

    public function setMailU(string $mailU): self
    {
        $this->mailU = $mailU;

        return $this;
    }

    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getIdServiceU(): array
    {
        return $this->idServiceU;
    }

    public function setIdServiceU(array $idServiceU): self
    {
        $this->idServiceU = $idServiceU;

        return $this;
    }

    public function getIdServiceFromForm(): ArrayCollection
    {
        return $this->idServiceFromForm;
    }

    public function setIdServiceFromForm(ArrayCollection $idServiceFromForm): self
    {
        $this->idServiceFromForm = $idServiceFromForm;

        return $this;
    }

    public function getCommentaireU(): ?string
    {
        return $this->commentaireU;
    }

    public function setCommentaireU(?string $commentaireU): self
    {
        $this->commentaireU = $commentaireU;

        return $this;
    }

    public function getDelegations(): ArrayCollection
    {
        return $this->delegations;
    }

}
