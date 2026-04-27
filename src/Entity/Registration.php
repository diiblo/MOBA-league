<?php

namespace App\Entity;

use App\Enum\RegistrationStatusEnum;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Registration
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'registrations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Competition $competition = null;

    #[ORM\ManyToOne(inversedBy: 'registrations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?LineUp $lineUp = null;

    #[ORM\Column(enumType: RegistrationStatusEnum::class)]
    private ?RegistrationStatusEnum $status = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $registeredAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    /**
     * @var Collection<int, PlayerStatsAggregate>
     */
    #[ORM\OneToMany(targetEntity: PlayerStatsAggregate::class, mappedBy: 'registration')]
    private Collection $playerStatsAggregates;

    public function __construct()
    {
        $this->playerStatsAggregates = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompetition(): ?Competition
    {
        return $this->competition;
    }

    public function setCompetition(?Competition $competition): static
    {
        $this->competition = $competition;

        return $this;
    }

    public function getLineUp(): ?LineUp
    {
        return $this->lineUp;
    }

    public function setLineUp(?LineUp $lineUp): static
    {
        $this->lineUp = $lineUp;

        return $this;
    }

    public function getStatus(): ?RegistrationStatusEnum
    {
        return $this->status;
    }

    public function setStatus(RegistrationStatusEnum $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getRegisteredAt(): ?\DateTimeImmutable
    {
        return $this->registeredAt;
    }

    public function setRegisteredAt(\DateTimeImmutable $registeredAt): static
    {
        $this->registeredAt = $registeredAt;

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
     * @return Collection<int, PlayerStatsAggregate>
     */
    public function getPlayerStatsAggregates(): Collection
    {
        return $this->playerStatsAggregates;
    }

    public function addPlayerStatsAggregate(PlayerStatsAggregate $playerStatsAggregate): static
    {
        if (!$this->playerStatsAggregates->contains($playerStatsAggregate)) {
            $this->playerStatsAggregates->add($playerStatsAggregate);
            $playerStatsAggregate->setRegistration($this);
        }

        return $this;
    }

    public function removePlayerStatsAggregate(PlayerStatsAggregate $playerStatsAggregate): static
    {
        if ($this->playerStatsAggregates->removeElement($playerStatsAggregate)) {
            if ($playerStatsAggregate->getRegistration() === $this) {
                $playerStatsAggregate->setRegistration(null);
            }
        }

        return $this;
    }
}
