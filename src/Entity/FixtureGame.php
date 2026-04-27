<?php

namespace App\Entity;

use App\Enum\FixtureGameReviewSourceEnum;
use App\Enum\FixtureGameStatusEnum;
use App\Enum\FixtureGameWinnerEnum;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class FixtureGame
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'games')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Fixture $fixture = null;

    #[ORM\Column]
    private ?int $gameNumber = null;

    #[ORM\Column(nullable: true)]
    private ?int $durationSecs = null;

    #[ORM\Column]
    private ?int $lineUpAKills = null;

    #[ORM\Column]
    private ?int $lineUpBKills = null;

    #[ORM\Column(length: 255)]
    private ?string $proofUrl = null;

    #[ORM\ManyToOne(inversedBy: 'uploadedFixtureGames')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $proofUploader = null;

    #[ORM\Column(enumType: FixtureGameReviewSourceEnum::class)]
    private ?FixtureGameReviewSourceEnum $reviewSource = null;

    #[ORM\ManyToOne(inversedBy: 'reviewedFixtureGames')]
    private ?User $reviewedBy = null;

    #[ORM\Column(enumType: FixtureGameStatusEnum::class)]
    private ?FixtureGameStatusEnum $status = null;

    #[ORM\Column(enumType: FixtureGameWinnerEnum::class)]
    private ?FixtureGameWinnerEnum $winner = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    /**
     * @var Collection<int, FixtureGameStatusHistory>
     */
    #[ORM\OneToMany(targetEntity: FixtureGameStatusHistory::class, mappedBy: 'fixtureGame', orphanRemoval: true)]
    private Collection $statusHistory;

    /**
     * @var Collection<int, Dispute>
     */
    #[ORM\OneToMany(targetEntity: Dispute::class, mappedBy: 'fixtureGame', orphanRemoval: true)]
    private Collection $disputes;

    /**
     * @var Collection<int, PlayerGameStat>
     */
    #[ORM\OneToMany(targetEntity: PlayerGameStat::class, mappedBy: 'fixtureGame', orphanRemoval: true)]
    private Collection $playerGameStats;

    public function __construct()
    {
        $this->statusHistory = new ArrayCollection();
        $this->disputes = new ArrayCollection();
        $this->playerGameStats = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFixture(): ?Fixture
    {
        return $this->fixture;
    }

    public function setFixture(?Fixture $fixture): static
    {
        $this->fixture = $fixture;

        return $this;
    }

    public function getGameNumber(): ?int
    {
        return $this->gameNumber;
    }

    public function setGameNumber(int $gameNumber): static
    {
        $this->gameNumber = $gameNumber;

        return $this;
    }

    public function getDurationSecs(): ?int
    {
        return $this->durationSecs;
    }

    public function setDurationSecs(?int $durationSecs): static
    {
        $this->durationSecs = $durationSecs;

        return $this;
    }

    public function getLineUpAKills(): ?int
    {
        return $this->lineUpAKills;
    }

    public function setLineUpAKills(int $lineUpAKills): static
    {
        $this->lineUpAKills = $lineUpAKills;

        return $this;
    }

    public function getLineUpBKills(): ?int
    {
        return $this->lineUpBKills;
    }

    public function setLineUpBKills(int $lineUpBKills): static
    {
        $this->lineUpBKills = $lineUpBKills;

        return $this;
    }

    public function getProofUrl(): ?string
    {
        return $this->proofUrl;
    }

    public function setProofUrl(string $proofUrl): static
    {
        $this->proofUrl = $proofUrl;

        return $this;
    }

    public function getProofUploader(): ?User
    {
        return $this->proofUploader;
    }

    public function setProofUploader(?User $proofUploader): static
    {
        $this->proofUploader = $proofUploader;

        return $this;
    }

    public function getReviewSource(): ?FixtureGameReviewSourceEnum
    {
        return $this->reviewSource;
    }

    public function setReviewSource(FixtureGameReviewSourceEnum $reviewSource): static
    {
        $this->reviewSource = $reviewSource;

        return $this;
    }

    public function getReviewedBy(): ?User
    {
        return $this->reviewedBy;
    }

    public function setReviewedBy(?User $reviewedBy): static
    {
        $this->reviewedBy = $reviewedBy;

        return $this;
    }

    public function getStatus(): ?FixtureGameStatusEnum
    {
        return $this->status;
    }

    public function setStatus(FixtureGameStatusEnum $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getWinner(): ?FixtureGameWinnerEnum
    {
        return $this->winner;
    }

    public function setWinner(FixtureGameWinnerEnum $winner): static
    {
        $this->winner = $winner;

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
     * @return Collection<int, FixtureGameStatusHistory>
     */
    public function getStatusHistory(): Collection
    {
        return $this->statusHistory;
    }

    public function addStatusHistory(FixtureGameStatusHistory $statusHistory): static
    {
        if (!$this->statusHistory->contains($statusHistory)) {
            $this->statusHistory->add($statusHistory);
            $statusHistory->setFixtureGame($this);
        }

        return $this;
    }

    public function removeStatusHistory(FixtureGameStatusHistory $statusHistory): static
    {
        if ($this->statusHistory->removeElement($statusHistory)) {
            if ($statusHistory->getFixtureGame() === $this) {
                $statusHistory->setFixtureGame(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Dispute>
     */
    public function getDisputes(): Collection
    {
        return $this->disputes;
    }

    public function addDispute(Dispute $dispute): static
    {
        if (!$this->disputes->contains($dispute)) {
            $this->disputes->add($dispute);
            $dispute->setFixtureGame($this);
        }

        return $this;
    }

    public function removeDispute(Dispute $dispute): static
    {
        if ($this->disputes->removeElement($dispute)) {
            if ($dispute->getFixtureGame() === $this) {
                $dispute->setFixtureGame(null);
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
            $playerGameStat->setFixtureGame($this);
        }

        return $this;
    }

    public function removePlayerGameStat(PlayerGameStat $playerGameStat): static
    {
        if ($this->playerGameStats->removeElement($playerGameStat)) {
            if ($playerGameStat->getFixtureGame() === $this) {
                $playerGameStat->setFixtureGame(null);
            }
        }

        return $this;
    }
}
