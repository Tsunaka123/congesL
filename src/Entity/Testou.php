<?php

namespace App\Entity;

use App\Repository\TestouRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TestouRepository::class)]
class Testou
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $testou = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $testouu = null;

    #[ORM\Column(length: 255)]
    private ?string $testouuu = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $text = null;

    #[ORM\Column]
    private ?bool $boolean = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTestou(): ?\DateTimeInterface
    {
        return $this->testou;
    }

    public function setTestou(\DateTimeInterface $testou): self
    {
        $this->testou = $testou;

        return $this;
    }

    public function getTestouu(): ?\DateTimeInterface
    {
        return $this->testouu;
    }

    public function setTestouu(?\DateTimeInterface $testouu): self
    {
        $this->testouu = $testouu;

        return $this;
    }

    public function getTestouuu(): ?string
    {
        return $this->testouuu;
    }

    public function setTestouuu(string $testouuu): self
    {
        $this->testouuu = $testouuu;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function isBoolean(): ?bool
    {
        return $this->boolean;
    }

    public function setBoolean(bool $boolean): self
    {
        $this->boolean = $boolean;

        return $this;
    }
}
