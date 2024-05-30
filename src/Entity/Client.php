<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client implements PasswordAuthenticatedUserInterface, UserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150, unique: true)]
    #[Assert\NotBlank(message: "Le nom de la compagnie est obligatoire")]
    #[Assert\Length(min: 2, max: 150, minMessage: "Le nom de la compagnie doit être de {{limit}} caractères minimum", maxMessage: "Le nom de la compagnie doit être de {{limit}} caractères maximum")]
    private ?string $company = null;

    #[ORM\Column(length: 255, unique: true)]
    #[Assert\NotBlank(message: "L'email est obligatoire")]
    #[Assert\Length(min: 5, max: 255, minMessage: "L'email doit être de {{limit}} caractères minimum", maxMessage: "L'email doit être de {{limit}} caractères maximum")]
    private ?string $email = null;

    #[ORM\Column(length: 72)]
    #[Assert\NotBlank(message: "Le mot de passe est obligatoire")]
    #[Assert\Length(min: 8, minMessage: "Le mot de passe doit être de {{limit}} caractères minimum")]
    private ?string $password = null;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'clients')]
    private Collection $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function setCompany(string $company): static
    {
        $this->company = $company;

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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        $this->users->removeElement($user);

        return $this;
    }

    public function getUsername(): string
    {
        return $this->company;
    }

    public function getRoles(): array
    {
        return [];
    }

    public function eraseCredentials(): void
    {
    }

    public function getUserIdentifier(): string
    {
        return $this->company;
    }
}
