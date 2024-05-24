<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["getUsers"])]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Groups(["getUsers"])]
    #[Assert\NotBlank(message: "La référence client est obligatoire, cela peut être le nom de la société, une abréviation, etc.")]
    #[Assert\Length(min: 2, max: 50, minMessage: "Le nom d'utilisateur doit être de {{limit}} caractères minimum", maxMessage: "Le nom d'utilisateur doit être de {{limit}} caractères maximum")]
    private ?string $clientReference = null;

    #[ORM\Column(length: 50, unique: true)]
    #[Groups(["getUsers"])]
    #[Assert\NotBlank(message: "Le nom d'utilisateur est obligatoire")]
    #[Assert\Length(min: 2, max: 50, minMessage: "Le nom d'utilisateur doit être de {{limit}} caractères minimum", maxMessage: "Le nom d'utilisateur doit être de {{limit}} caractères maximum")]
    private ?string $username = null;

    #[ORM\Column(length: 255, unique: true)]
    #[Groups(["getUsers"])]
    #[Assert\NotBlank(message: "L'email' est obligatoire")]
    #[Assert\Length(min: 5, max: 255, minMessage: "L'email doit être de {{limit}} caractères minimum", maxMessage: "L'email doit être de {{limit}} caractères maximum")]
    private ?string $email = null;

    #[ORM\Column(length: 50)]
    #[Groups(["getUsers"])]
    #[Assert\NotBlank(message: "Le prénom est obligatoire")]
    #[Assert\Length(min: 2, max: 50, minMessage: "Le prénom doit être de {{limit}} caractères minimum", maxMessage: "Le prénom doit être de {{limit}} caractères maximum")]
    private ?string $firstname = null;

    #[ORM\Column(length: 50)]
    #[Groups(["getUsers"])]
    #[Assert\NotBlank(message: "Le nom est obligatoire")]
    #[Assert\Length(min: 2, max: 50, minMessage: "Le nom doit être de {{limit}} caractères minimum", maxMessage: "Le nom doit être de {{limit}} caractères maximum")]
    private ?string $lastname = null;

    #[ORM\Column(length: 25, nullable: true, unique: true)]
    #[Groups(["getUsers"])]
    private ?string $phoneNumber = null;

    #[ORM\Column(type: 'json')]
    private $roles = [];

    /**
     * @var Collection<int, Address>
     */
    #[ORM\OneToMany(targetEntity: Address::class, mappedBy: 'user')]
    #[Groups(["getUsers"])]
    private Collection $addresses;

    public function __construct()
    {
        $this->addresses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): static
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * @return Collection<int, Address>
     */
    public function getAddresses(): Collection
    {
        return $this->addresses;
    }

    public function addAddress(Address $address): static
    {
        if (!$this->addresses->contains($address)) {
            $this->addresses->add($address);
            $address->setUser($this);
        }

        return $this;
    }

    public function removeAddress(Address $address): static
    {
        if ($this->addresses->removeElement($address)) {
            // set the owning side to null (unless already changed)
            if ($address->getUser() === $this) {
                $address->setUser(null);
            }
        }

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

    public function getClientReference(): ?string
    {
        return $this->clientReference;
    }

    public function setClientReference(string $clientReference): static
    {
        $this->clientReference = $clientReference;

        return $this;
    }
}
