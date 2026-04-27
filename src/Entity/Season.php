<?php

namespace App\Entity;

use App\Enum\SeasonStatusEnum;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Season
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $number = null;

    #[ORM\Column(enumType: SeasonStatusEnum::class)]
    private ?SeasonStatusEnum $status = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $startDate = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $endDate = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    /**
     * @var Collection<int, Competition>
     */
    #[ORM\OneToMany(targetEntity: Competition::class, mappedBy: 'season')]
    private Collection $competitions;

    /**
     * @var Collection<int, PlayerStatsAggregate>
     */
    #[ORM\OneToMany(targetEntity: PlayerStatsAggregate::class, mappedBy: 'season')]
    private Collection $playerStatsAggregates;

    public function __construct()
    {
        $this->competitions = new ArrayCollection();
        $this->playerStatsAggregates = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): static
    {
        $this->number = $number;

        return $this;
    }

    public function getStatus(): ?SeasonStatusEnum
    {
        return $this->status;
    }

    public function setStatus(SeasonStatusEnum $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getStartDate(): ?\DateTimeImmutable
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeImmutable $startDate): static
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeImmutable
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeImmutable $endDate): static
    {
        $this->endDate = $endDate;

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
            $competition->setSeason($this);
        }

        return $this;
    }

    public function removeCompetition(Competition $competition): static
    {
        if ($this->competitions->removeElement($competition)) {
            if ($competition->getSeason() === $this) {
                $competition->setSeason(null);
            }
        }

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
            $playerStatsAggregate->setSeason($this);
        }

        return $this;
    }

    public function removePlayerStatsAggregate(PlayerStatsAggregate $playerStatsAggregate): static
    {
        if ($this->playerStatsAggregates->removeElement($playerStatsAggregate)) {
            if ($playerStatsAggregate->getSeason() === $this) {
                $playerStatsAggregate->setSeason(null);
            }
        }

        return $this;
    }
}
