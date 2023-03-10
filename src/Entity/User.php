<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\DocBlock\Tags\TagWithType;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Table(name: 'User')]
#[UniqueEntity('mailU', 'loginU')]
#[ORM\Entity(repositoryClass: UserRepository::class)]
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
    private array $roles = ['ROLE_USER'];

    #[ORM\Column(nullable: true)]
    private int $idServiceU;

    /**
     *Utilisation possible pour sous service
    private int $idServiceFromForm;
    */

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $commentaireU = null;

    #[ORM\OneToOne(mappedBy: "user", targetEntity: Service::class)]
    private $service;

    #[ORM\OneToOne(mappedBy: "user", targetEntity: CongesDemande::class)]
    private $congesdemande;

    #[ORM\OneToMany(mappedBy: "idUserDelegue", targetEntity: Delegation::class)]
    private Collection $delegationsIdUserDelegue;

    #[ORM\OneToMany(mappedBy: "idUserDelegant", targetEntity: Delegation::class)]
    private Collection $delegationsIdUserDelegant;


    public function eraseCredentials()
    {
    }

    public function __construct()
    {
        $this->delegationsIdUserDelegant = new ArrayCollection();
        $this->delegationsIdUserDelegue = new ArrayCollection();
        $this->roles = ['ROLE_USER'];
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
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getIdServiceU(): int
    {
        return $this->idServiceU;
    }

    public function setIdServiceU(int $idServiceU): self
    {
        $this->idServiceU = $idServiceU;

        return $this;
    }

    /**
     * Utilisation possible pour sous service
    public function getIdServiceFromForm(): int
    {
        return $this->idServiceFromForm;
    }

    public function setIdServiceFromForm(int $idServiceFromForm): self
    {
        $this->idServiceFromForm = $idServiceFromForm;

        return $this;
    }
     */

    public function getCommentaireU(): ?string
    {
        return $this->commentaireU;
    }

    public function setCommentaireU(?string $commentaireU): self
    {
        $this->commentaireU = $commentaireU;

        return $this;
    }

    public function getDelegationsIdUserDelegant(): ArrayCollection
    {
        return $this->delegationsIdUserDelegant;
    }

    public function getDelegationsIdUserDelegue(): ArrayCollection
    {
        return $this->delegationsIdUserDelegue;
    }

        public function getService(): ?Service
{
    return $this->service;
}

    public function setService(Service $service): self
{
    $this->service = $service;

    return $this;
}

}
