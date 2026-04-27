<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class PlayerProfile
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'playerProfile')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $owner = null;

    #[ORM\Column(length: 255)]
    private ?string $pseudo = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $bio = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    /**
     * @var Collection<int, PlayerProfileRole>
     */
    #[ORM\OneToMany(targetEntity: PlayerProfileRole::class, mappedBy: 'playerProfile', orphanRemoval: true)]
    private Collection $roles;

    /**
     * @var Collection<int, PlayerStatsAggregate>
     */
    #[ORM\OneToMany(targetEntity: PlayerStatsAggregate::class, mappedBy: 'playerProfile')]
    private Collection $statsAggregates;

    /**
     * @var Collection<int, PlayerGameStat>
     */
    #[ORM\OneToMany(targetEntity: PlayerGameStat::class, mappedBy: 'playerProfile')]
    private Collection $playerGameStats;

    public function __construct()
    {
        $this->roles = new ArrayCollection();
        $this->statsAggregates = new ArrayCollection();
        $this->playerGameStats = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): static
    {
        $this->owner = $owner;

        return $this;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): static
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getBio(): ?string
    {
        return $this->bio;
    }

    public function setBio(string $bio): static
    {
        $this->bio = $bio;

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
     * @return Collection<int, PlayerProfileRole>
     */
    public function getRoles(): Collection
    {
        return $this->roles;
    }

    public function addRole(PlayerProfileRole $role): static
    {
        if (!$this->roles->contains($role)) {
            $this->roles->add($role);
            $role->setPlayerProfile($this);
        }

        return $this;
    }

    public function removeRole(PlayerProfileRole $role): static
    {
        if ($this->roles->removeElement($role)) {
            if ($role->getPlayerProfile() === $this) {
                $role->setPlayerProfile(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, PlayerStatsAggregate>
     */
    public function getStatsAggregates(): Collection
    {
        return $this->statsAggregates;
    }

    public function addStatsAggregate(PlayerStatsAggregate $statsAggregate): static
    {
        if (!$this->statsAggregates->contains($statsAggregate)) {
            $this->statsAggregates->add($statsAggregate);
            $statsAggregate->setPlayerProfile($this);
        }

        return $this;
    }

    public function removeStatsAggregate(PlayerStatsAggregate $statsAggregate): static
    {
        if ($this->statsAggregates->removeElement($statsAggregate)) {
            if ($statsAggregate->getPlayerProfile() === $this) {
                $statsAggregate->setPlayerProfile(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, PlayerGameStat>
     */
    public function getPlayerGameStats(): Collection
    {
        return $this->playerGameStats;
    }

    public function addPlayerGameStat(PlayerGameStat $playerGameStat): static
    {
        if (!$this->playerGameStats->contains($playerGameStat)) {
            $this->playerGameStats->add($playerGameStat);
            $playerGameStat->setPlayerProfile($this);
        }

        return $this;
    }

    public function removePlayerGameStat(PlayerGameStat $playerGameStat): static
    {
        if ($this->playerGameStats->removeElement($playerGameStat)) {
            if ($playerGameStat->getPlayerProfile() === $this) {
                $playerGameStat->setPlayerProfile(null);
            }
        }

        return $this;
    }
}
