<?php

namespace App\Entity;

use App\Enum\CompetitionStatusEnum;
use App\Enum\CompetitionTypeEnum;
use App\Enum\FixtureFormatEnum;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Competition
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'competitions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $owner = null;

    #[ORM\ManyToOne(inversedBy: 'competitions')]
    private ?Season $season = null;

    #[ORM\ManyToOne(inversedBy: 'competitions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?GameTitle $gameTitle = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(enumType: CompetitionTypeEnum::class)]
    private ?CompetitionTypeEnum $type = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(enumType: FixtureFormatEnum::class)]
    private ?FixtureFormatEnum $fixtureFormat = null;

    #[ORM\Column]
    private ?int $maxTeams = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $registrationOpenAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $registrationCloseAt = null;

    #[ORM\Column(enumType: CompetitionStatusEnum::class)]
    private ?CompetitionStatusEnum $status = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $startDate = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $endDate = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    /**
     * @var Collection<int, Registration>
     */
    #[ORM\OneToMany(targetEntity: Registration::class, mappedBy: 'competition', orphanRemoval: true)]
    private Collection $registrations;

    /**
     * @var Collection<int, LeagueRound>
     */
    #[ORM\OneToMany(targetEntity: LeagueRound::class, mappedBy: 'competition', orphanRemoval: true)]
    private Collection $rounds;

    /**
     * @var Collection<int, Fixture>
     */
    #[ORM\OneToMany(targetEntity: Fixture::class, mappedBy: 'competition', orphanRemoval: true)]
    private Collection $fixtures;

    /**
     * @var Collection<int, Standing>
     */
    #[ORM\OneToMany(targetEntity: Standing::class, mappedBy: 'competition', orphanRemoval: true)]
    private Collection $standings;

    #[ORM\OneToOne(mappedBy: 'competition', cascade: ['persist', 'remove'])]
    private ?Bracket $bracket = null;

    /**
     * @var Collection<int, CompetitionRule>
     */
    #[ORM\OneToMany(targetEntity: CompetitionRule::class, mappedBy: 'competition', orphanRemoval: true)]
    private Collection $rules;

    /**
     * @var Collection<int, QualificationSlot>
     */
    #[ORM\OneToMany(targetEntity: QualificationSlot::class, mappedBy: 'sourceCompetition')]
    private Collection $sourceQualificationSlots;

    /**
     * @var Collection<int, QualificationSlot>
     */
    #[ORM\OneToMany(targetEntity: QualificationSlot::class, mappedBy: 'targetCompetition')]
    private Collection $targetQualificationSlots;

    public function __construct()
    {
        $this->registrations = new ArrayCollection();
        $this->rounds = new ArrayCollection();
        $this->fixtures = new ArrayCollection();
        $this->standings = new ArrayCollection();
        $this->rules = new ArrayCollection();
        $this->sourceQualificationSlots = new ArrayCollection();
        $this->targetQualificationSlots = new ArrayCollection();
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

    public function getSeason(): ?Season
    {
        return $this->season;
    }

    public function setSeason(?Season $season): static
    {
        $this->season = $season;

        return $this;
    }

    public function getGameTitle(): ?GameTitle
    {
        return $this->gameTitle;
    }

    public function setGameTitle(?GameTitle $gameTitle): static
    {
        $this->gameTitle = $gameTitle;

        return $this;
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

    public function getType(): ?CompetitionTypeEnum
    {
        return $this->type;
    }

    public function setType(CompetitionTypeEnum $type): static
    {
        $this->type = $type;

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

    public function getFixtureFormat(): ?FixtureFormatEnum
    {
        return $this->fixtureFormat;
    }

    public function setFixtureFormat(FixtureFormatEnum $fixtureFormat): static
    {
        $this->fixtureFormat = $fixtureFormat;

        return $this;
    }

    public function getMaxTeams(): ?int
    {
        return $this->maxTeams;
    }

    public function setMaxTeams(int $maxTeams): static
    {
        $this->maxTeams = $maxTeams;

        return $this;
    }

    public function getRegistrationOpenAt(): ?\DateTimeImmutable
    {
        return $this->registrationOpenAt;
    }

    public function setRegistrationOpenAt(\DateTimeImmutable $registrationOpenAt): static
    {
        $this->registrationOpenAt = $registrationOpenAt;

        return $this;
    }

    public function getRegistrationCloseAt(): ?\DateTimeImmutable
    {
        return $this->registrationCloseAt;
    }

    public function setRegistrationCloseAt(\DateTimeImmutable $registrationCloseAt): static
    {
        $this->registrationCloseAt = $registrationCloseAt;

        return $this;
    }

    public function getStatus(): ?CompetitionStatusEnum
    {
        return $this->status;
    }

    public function setStatus(CompetitionStatusEnum $status): static
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
     * @return Collection<int, Registration>
     */
    public function getRegistrations(): Collection
    {
        return $this->registrations;
    }

    public function addRegistration(Registration $registration): static
    {
        if (!$this->registrations->contains($registration)) {
            $this->registrations->add($registration);
            $registration->setCompetition($this);
        }

        return $this;
    }

    public function removeRegistration(Registration $registration): static
    {
        if ($this->registrations->removeElement($registration)) {
            if ($registration->getCompetition() === $this) {
                $registration->setCompetition(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, LeagueRound>
     */
    public function getRounds(): Collection
    {
        return $this->rounds;
    }

    public function addRound(LeagueRound $round): static
    {
        if (!$this->rounds->contains($round)) {
            $this->rounds->add($round);
            $round->setCompetition($this);
        }

        return $this;
    }

    public function removeRound(LeagueRound $round): static
    {
        if ($this->rounds->removeElement($round)) {
            if ($round->getCompetition() === $this) {
                $round->setCompetition(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Fixture>
     */
    public function getFixtures(): Collection
    {
        return $this->fixtures;
    }

    public function addFixture(Fixture $fixture): static
    {
        if (!$this->fixtures->contains($fixture)) {
            $this->fixtures->add($fixture);
            $fixture->setCompetition($this);
        }

        return $this;
    }

    public function removeFixture(Fixture $fixture): static
    {
        if ($this->fixtures->removeElement($fixture)) {
            if ($fixture->getCompetition() === $this) {
                $fixture->setCompetition(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Standing>
     */
    public function getStandings(): Collection
    {
        return $this->standings;
    }

    public function addStanding(Standing $standing): static
    {
        if (!$this->standings->contains($standing)) {
            $this->standings->add($standing);
            $standing->setCompetition($this);
        }

        return $this;
    }

    public function removeStanding(Standing $standing): static
    {
        if ($this->standings->removeElement($standing)) {
            if ($standing->getCompetition() === $this) {
                $standing->setCompetition(null);
            }
        }

        return $this;
    }

    public function getBracket(): ?Bracket
    {
        return $this->bracket;
    }

    public function setBracket(?Bracket $bracket): static
    {
        if (null === $bracket && null !== $this->bracket) {
            $this->bracket->setCompetition(null);
        }

        if (null !== $bracket && $bracket->getCompetition() !== $this) {
            $bracket->setCompetition($this);
        }

        $this->bracket = $bracket;

        return $this;
    }

    /**
     * @return Collection<int, CompetitionRule>
     */
    public function getRules(): Collection
    {
        return $this->rules;
    }

    public function addRule(CompetitionRule $rule): static
    {
        if (!$this->rules->contains($rule)) {
            $this->rules->add($rule);
            $rule->setCompetition($this);
        }

        return $this;
    }

    public function removeRule(CompetitionRule $rule): static
    {
        if ($this->rules->removeElement($rule)) {
            if ($rule->getCompetition() === $this) {
                $rule->setCompetition(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, QualificationSlot>
     */
    public function getSourceQualificationSlots(): Collection
    {
        return $this->sourceQualificationSlots;
    }

    public function addSourceQualificationSlot(QualificationSlot $sourceQualificationSlot): static
    {
        if (!$this->sourceQualificationSlots->contains($sourceQualificationSlot)) {
            $this->sourceQualificationSlots->add($sourceQualificationSlot);
            $sourceQualificationSlot->setSourceCompetition($this);
        }

        return $this;
    }

    public function removeSourceQualificationSlot(QualificationSlot $sourceQualificationSlot): static
    {
        if ($this->sourceQualificationSlots->removeElement($sourceQualificationSlot)) {
            if ($sourceQualificationSlot->getSourceCompetition() === $this) {
                $sourceQualificationSlot->setSourceCompetition(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, QualificationSlot>
     */
    public function getTargetQualificationSlots(): Collection
    {
        return $this->targetQualificationSlots;
    }

    public function addTargetQualificationSlot(QualificationSlot $targetQualificationSlot): static
    {
        if (!$this->targetQualificationSlots->contains($targetQualificationSlot)) {
            $this->targetQualificationSlots->add($targetQualificationSlot);
            $targetQualificationSlot->setTargetCompetition($this);
        }

        return $this;
    }

    public function removeTargetQualificationSlot(QualificationSlot $targetQualificationSlot): static
    {
        if ($this->targetQualificationSlots->removeElement($targetQualificationSlot)) {
            if ($targetQualificationSlot->getTargetCompetition() === $this) {
                $targetQualificationSlot->setTargetCompetition(null);
            }
        }

        return $this;
    }
}
