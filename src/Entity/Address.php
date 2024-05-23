<?php

namespace App\Entity;

use App\Repository\AddressRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: AddressRepository::class)]
class Address
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["getUsers"])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(["getUsers"])]
    #[Assert\NotBlank(message: "Le nom de la rue est obligatoire")]
    #[Assert\Length(min: 2, max: 255, minMessage: "Le nom de la rue doit être de {{limit}} caractères minimum", maxMessage: "Le nom de la rue doit être de {{limit}} caractères maximum")]
    private ?string $street = null;

    #[ORM\Column(length: 100)]
    #[Groups(["getUsers"])]
    #[Assert\NotBlank(message: "Le nom de la ville est obligatoire")]
    #[Assert\Length(min: 2, max: 100, minMessage: "Le nom de la ville doit être de {{limit}} caractères minimum", maxMessage: "Le nom de la ville doit être de {{limit}} caractères maximum")]
    private ?string $city = null;

    #[ORM\Column(length: 10)]
    #[Groups(["getUsers"])]
    #[Assert\NotBlank(message: "Le code postal est obligatoire")]
    #[Assert\Length(min: 5, max: 10, minMessage: "Le code postal doit être de {{limit}} caractères minimum", maxMessage: "Le code postal doit être de {{limit}} caractères maximum")]
    private ?string $zipCode = null;

    #[ORM\Column(length: 100)]
    #[Groups(["getUsers"])]
    #[Assert\NotBlank(message: "Le nom du pays est obligatoire")]
    #[Assert\Length(min: 4, max: 100, minMessage: "Le nom du pays doit être de {{limit}} caractères minimum", maxMessage: "Le nom du pays doit être de {{limit}} caractères maximum")]
    private ?string $country = null;

    #[ORM\ManyToOne(inversedBy: 'addresses')]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(string $street): static
    {
        $this->street = $street;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function getZipCode(): ?string
    {
        return $this->zipCode;
    }

    public function setZipCode(string $zipCode): static
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): static
    {
        $this->country = $country;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }
}
