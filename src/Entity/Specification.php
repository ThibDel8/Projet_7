<?php

namespace App\Entity;

use App\Repository\SpecificationRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: SpecificationRepository::class)]
class Specification
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $weight = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $resolution = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $processor = null;

    #[ORM\Column(length: 4, nullable: true)]
    private ?string $ram = null;

    #[ORM\Column(length: 5, nullable: true)]
    private ?string $storage = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $battery = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank(message: "Le nom du système d'exploitation est obligatoire")]
    #[Assert\Length(min: 2, max: 50, minMessage: "Le nom du système d'exploitation doit être de {{limit}} caractères minimum", maxMessage: "Le nom du système d'exploitation doit être de {{limit}} caractères maximum")]
    private ?string $os = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWeight(): ?int
    {
        return $this->weight;
    }

    public function setWeight(int $weight): static
    {
        $this->weight = $weight;

        return $this;
    }

    public function getResolution(): ?string
    {
        return $this->resolution;
    }

    public function setResolution(string $resolution): static
    {
        $this->resolution = $resolution;

        return $this;
    }

    public function getProcessor(): ?string
    {
        return $this->processor;
    }

    public function setProcessor(string $processor): static
    {
        $this->processor = $processor;

        return $this;
    }

    public function getRam(): ?string
    {
        return $this->ram;
    }

    public function setRam(string $ram): static
    {
        $this->ram = $ram;

        return $this;
    }

    public function getStorage(): ?string
    {
        return $this->storage;
    }

    public function setStorage(string $storage): static
    {
        $this->storage = $storage;

        return $this;
    }

    public function getBattery(): ?string
    {
        return $this->battery;
    }

    public function setBattery(string $battery): static
    {
        $this->battery = $battery;

        return $this;
    }

    public function getOs(): ?string
    {
        return $this->os;
    }

    public function setOs(string $os): static
    {
        $this->os = $os;

        return $this;
    }
}
