<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[UniqueEntity('email', 'username')]
#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['username'], message: 'There is already an account with this username')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Delegation", cascade={"persist"})
     */
    private $delegation;


    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private array $roles = [];

    #[ORM\Column(length: 25)]
    #[Assert\NotBlank]
    #[Assert\Length(min: 2, max: 25)]
    private ?string $firstName = null;

    #[ORM\Column(length: 25)]
    #[Assert\NotBlank]
    #[Assert\Length(min: 2, max: 25)]
    private ?string $lastName = null;

    #[ORM\Column(length: 50)]
    #[Assert\Email]
    #[Assert\NotBlank]
    #[Assert\Length(min: 2, max: 50)]
    private ?string $email = null;

    #[ORM\Column(length: 25, unique: true)]
    #[Assert\NotBlank]
    #[Assert\Length(min: 2, max: 25)]
    private ?string $username = null;

    #[ORM\Column]
    #[Assert\Length(min: 2, max: 250)]
    private ?string $password = null;

    public function eraseCredentials()
    {

    }

    public function getDelegation(): ?int
    {
        return $this->delegation;
    }

    public function setDelegation(array $delegation): self
    {
        $this->delegation = $delegation;

        return $this;
    }


    public function getId(): ?int
    {
        return $this->id;
    }


    public function getUserIdentifier(): string
    {
        return (string)$this->username;
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


    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }


    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }


    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }


    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }


    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

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
}