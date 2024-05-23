<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank(message: "Le nom de la marque est obligatoire")]
    #[Assert\Length(min: 2, max: 50, minMessage: "Le nom de la marque doit être de {{limit}} caractères minimum", maxMessage: "Le nom de la marque doit être de {{limit}} caractères maximum")]
    private ?string $brand = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Le nom du modèle est obligatoire")]
    #[Assert\Length(min: 2, max: 255, minMessage: "Le nom du modèle doit être de {{limit}} caractères minimum", maxMessage: "Le nom du modèle doit être de {{limit}} caractères maximum")]
    private ?string $model = null;

    #[ORM\Column(nullable: true)]
    private ?float $price = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $color = null;

    #[ORM\Column]
    #[Assert\NotBlank(message: "Le stock est obligatoire")]
    private ?bool $stock = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Specification $specs = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): static
    {
        $this->brand = $brand;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): static
    {
        $this->model = $model;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): static
    {
        $this->color = $color;

        return $this;
    }

    public function isStock(): ?bool
    {
        return $this->stock;
    }

    public function setStock(bool $stock): static
    {
        $this->stock = $stock;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getSpecs(): ?Specification
    {
        return $this->specs;
    }

    public function setSpecs(?Specification $specs): static
    {
        $this->specs = $specs;

        return $this;
    }
}
