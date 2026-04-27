<?php

namespace App\Entity;

use App\Enum\FixtureOpponentStatusEnum;
use App\Enum\FixtureStatusEnum;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Fixture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'fixtures')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Competition $competition = null;

    #[ORM\ManyToOne(inversedBy: 'fixtures')]
    private ?LeagueRound $leagueRound = null;

    #[ORM\ManyToOne(inversedBy: 'fixtures')]
    private ?VenueSlot $venueSlot = null;

    #[ORM\ManyToOne(inversedBy: 'fixturesAsA')]
    #[ORM\JoinColumn(nullable: false)]
    private ?LineUp $lineUpA = null;

    #[ORM\ManyToOne(inversedBy: 'fixturesAsB')]
    private ?LineUp $lineUpB = null;

    #[ORM\Column(enumType: FixtureOpponentStatusEnum::class)]
    private ?FixtureOpponentStatusEnum $opponentStatus = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $scheduledAt = null;

    #[ORM\Column(enumType: FixtureStatusEnum::class)]
    private ?FixtureStatusEnum $status = null;

    #[ORM\ManyToOne(inversedBy: 'forfeitedFixtures')]
    private ?LineUp $forfeitedByLineUp = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $forfeitedAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    /**
     * @var Collection<int, FixtureGame>
     */
    #[ORM\OneToMany(targetEntity: FixtureGame::class, mappedBy: 'fixture', orphanRemoval: true)]
    private Collection $games;

    #[ORM\OneToOne(mappedBy: 'fixture', cascade: ['persist', 'remove'])]
    private ?Result $result = null;

    /**
     * @var Collection<int, StreamLink>
     */
    #[ORM\OneToMany(targetEntity: StreamLink::class, mappedBy: 'fixture')]
    private Collection $streamLinks;

    #[ORM\OneToOne(mappedBy: 'fixture', cascade: ['persist', 'remove'])]
    private ?BracketNode $bracketNode = null;

    public function __construct()
    {
        $this->games = new ArrayCollection();
        $this->streamLinks = new ArrayCollection();
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

    public function getLeagueRound(): ?LeagueRound
    {
        return $this->leagueRound;
    }

    public function setLeagueRound(?LeagueRound $leagueRound): static
    {
        $this->leagueRound = $leagueRound;

        return $this;
    }

    public function getVenueSlot(): ?VenueSlot
    {
        return $this->venueSlot;
    }

    public function setVenueSlot(?VenueSlot $venueSlot): static
    {
        $this->venueSlot = $venueSlot;

        return $this;
    }

    public function getLineUpA(): ?LineUp
    {
        return $this->lineUpA;
    }

    public function setLineUpA(?LineUp $lineUpA): static
    {
        $this->lineUpA = $lineUpA;

        return $this;
    }

    public function getLineUpB(): ?LineUp
    {
        return $this->lineUpB;
    }

    public function setLineUpB(?LineUp $lineUpB): static
    {
        $this->lineUpB = $lineUpB;

        return $this;
    }

    public function getOpponentStatus(): ?FixtureOpponentStatusEnum
    {
        return $this->opponentStatus;
    }

    public function setOpponentStatus(FixtureOpponentStatusEnum $opponentStatus): static
    {
        $this->opponentStatus = $opponentStatus;

        return $this;
    }

    public function getScheduledAt(): ?\DateTimeImmutable
    {
        return $this->scheduledAt;
    }

    public function setScheduledAt(\DateTimeImmutable $scheduledAt): static
    {
        $this->scheduledAt = $scheduledAt;

        return $this;
    }

    public function getStatus(): ?FixtureStatusEnum
    {
        return $this->status;
    }

    public function setStatus(FixtureStatusEnum $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getForfeitedByLineUp(): ?LineUp
    {
        return $this->forfeitedByLineUp;
    }

    public function setForfeitedByLineUp(?LineUp $forfeitedByLineUp): static
    {
        $this->forfeitedByLineUp = $forfeitedByLineUp;

        return $this;
    }

    public function getForfeitedAt(): ?\DateTimeImmutable
    {
        return $this->forfeitedAt;
    }

    public function setForfeitedAt(?\DateTimeImmutable $forfeitedAt): static
    {
        $this->forfeitedAt = $forfeitedAt;

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
     * @return Collection<int, FixtureGame>
     */
    public function getGames(): Collection
    {
        return $this->games;
    }

    public function addGame(FixtureGame $game): static
    {
        if (!$this->games->contains($game)) {
            $this->games->add($game);
            $game->setFixture($this);
        }

        return $this;
    }

    public function removeGame(FixtureGame $game): static
    {
        if ($this->games->removeElement($game)) {
            if ($game->getFixture() === $this) {
                $game->setFixture(null);
            }
        }

        return $this;
    }

    public function getResult(): ?Result
    {
        return $this->result;
    }

    public function setResult(?Result $result): static
    {
        if (null === $result && null !== $this->result) {
            $this->result->setFixture(null);
        }

        if (null !== $result && $result->getFixture() !== $this) {
            $result->setFixture($this);
        }

        $this->result = $result;

        return $this;
    }

    /**
     * @return Collection<int, StreamLink>
     */
    public function getStreamLinks(): Collection
    {
        return $this->streamLinks;
    }

    public function addStreamLink(StreamLink $streamLink): static
    {
        if (!$this->streamLinks->contains($streamLink)) {
            $this->streamLinks->add($streamLink);
            $streamLink->setFixture($this);
        }

        return $this;
    }

    public function removeStreamLink(StreamLink $streamLink): static
    {
        if ($this->streamLinks->removeElement($streamLink)) {
            if ($streamLink->getFixture() === $this) {
                $streamLink->setFixture(null);
            }
        }

        return $this;
    }

    public function getBracketNode(): ?BracketNode
    {
        return $this->bracketNode;
    }

    public function setBracketNode(?BracketNode $bracketNode): static
    {
        if (null === $bracketNode && null !== $this->bracketNode) {
            $this->bracketNode->setFixture(null);
        }

        if (null !== $bracketNode && $bracketNode->getFixture() !== $this) {
            $bracketNode->setFixture($this);
        }

        $this->bracketNode = $bracketNode;

        return $this;
    }
}
