<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class GameTitle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $logoUrl = null;

    #[ORM\Column]
    private ?bool $isActive = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    /**
     * @var Collection<int, Champion>
     */
    #[ORM\OneToMany(targetEntity: Champion::class, mappedBy: 'gameTitle')]
    private Collection $champions;

    /**
     * @var Collection<int, Competition>
     */
    #[ORM\OneToMany(targetEntity: Competition::class, mappedBy: 'gameTitle')]
    private Collection $competitions;

    /**
     * @var Collection<int, PlayerProfileRole>
     */
    #[ORM\OneToMany(targetEntity: PlayerProfileRole::class, mappedBy: 'gameTitle')]
    private Collection $playerProfileRoles;

    public function __construct()
    {
        $this->champions = new ArrayCollection();
        $this->competitions = new ArrayCollection();
        $this->playerProfileRoles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    public function getLogoUrl(): ?string
    {
        return $this->logoUrl;
    }

    public function setLogoUrl(?string $logoUrl): static
    {
        $this->logoUrl = $logoUrl;

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): static
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return Collection<int, Champion>
     */
    public function getChampions(): Collection
    {
        return $this->champions;
    }

    public function addChampion(Champion $champion): static
    {
        if (!$this->champions->contains($champion)) {
            $this->champions->add($champion);
            $champion->setGameTitle($this);
        }

        return $this;
    }

    public function removeChampion(Champion $champion): static
    {
        if ($this->champions->removeElement($champion)) {
            if ($champion->getGameTitle() === $this) {
                $champion->setGameTitle(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Competition>
     */
    public function getCompetitions(): Collection
    {
        return $this->competitions;
    }

    public function addCompetition(Competition $competition): static
    {
        if (!$this->competitions->contains($competition)) {
            $this->competitions->add($competition);
            $competition->setGameTitle($this);
        }

        return $this;
    }

    public function removeCompetition(Competition $competition): static
    {
        if ($this->competitions->removeElement($competition)) {
            if ($competition->getGameTitle() === $this) {
                $competition->setGameTitle(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, PlayerProfileRole>
     */
    public function getPlayerProfileRoles(): Collection
    {
        return $this->playerProfileRoles;
    }

    public function addPlayerProfileRole(PlayerProfileRole $playerProfileRole): static
    {
        if (!$this->playerProfileRoles->contains($playerProfileRole)) {
            $this->playerProfileRoles->add($playerProfileRole);
            $playerProfileRole->setGameTitle($this);
        }

        return $this;
    }

    public function removePlayerProfileRole(PlayerProfileRole $playerProfileRole): static
    {
        if ($this->playerProfileRoles->removeElement($playerProfileRole)) {
            if ($playerProfileRole->getGameTitle() === $this) {
                $playerProfileRole->setGameTitle(null);
            }
        }

        return $this;
    }
}
