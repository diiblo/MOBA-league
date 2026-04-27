<?php

namespace App\Entity;

use App\Enum\LineUpStatusEnum;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class LineUp
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'lineUps')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Team $team = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(enumType: LineUpStatusEnum::class)]
    private ?LineUpStatusEnum $status = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    /**
     * @var Collection<int, LineUpMember>
     */
    #[ORM\OneToMany(targetEntity: LineUpMember::class, mappedBy: 'lineUp', orphanRemoval: true)]
    private Collection $members;

    /**
     * @var Collection<int, Registration>
     */
    #[ORM\OneToMany(targetEntity: Registration::class, mappedBy: 'lineUp')]
    private Collection $registrations;

    /**
     * @var Collection<int, Standing>
     */
    #[ORM\OneToMany(targetEntity: Standing::class, mappedBy: 'lineUp')]
    private Collection $standings;

    /**
     * @var Collection<int, Fixture>
     */
    #[ORM\OneToMany(targetEntity: Fixture::class, mappedBy: 'lineUpA')]
    private Collection $fixturesAsA;

    /**
     * @var Collection<int, Fixture>
     */
    #[ORM\OneToMany(targetEntity: Fixture::class, mappedBy: 'lineUpB')]
    private Collection $fixturesAsB;

    /**
     * @var Collection<int, Fixture>
     */
    #[ORM\OneToMany(targetEntity: Fixture::class, mappedBy: 'forfeitedByLineUp')]
    private Collection $forfeitedFixtures;

    /**
     * @var Collection<int, BracketEntry>
     */
    #[ORM\OneToMany(targetEntity: BracketEntry::class, mappedBy: 'lineUp')]
    private Collection $bracketEntries;

    public function __construct()
    {
        $this->members = new ArrayCollection();
        $this->registrations = new ArrayCollection();
        $this->standings = new ArrayCollection();
        $this->fixturesAsA = new ArrayCollection();
        $this->fixturesAsB = new ArrayCollection();
        $this->forfeitedFixtures = new ArrayCollection();
        $this->bracketEntries = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTeam(): ?Team
    {
        return $this->team;
    }

    public function setTeam(?Team $team): static
    {
        $this->team = $team;

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

    public function getStatus(): ?LineUpStatusEnum
    {
        return $this->status;
    }

    public function setStatus(LineUpStatusEnum $status): static
    {
        $this->status = $status;

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
     * @return Collection<int, LineUpMember>
     */
    public function getMembers(): Collection
    {
        return $this->members;
    }

    public function addMember(LineUpMember $member): static
    {
        if (!$this->members->contains($member)) {
            $this->members->add($member);
            $member->setLineUp($this);
        }

        return $this;
    }

    public function removeMember(LineUpMember $member): static
    {
        if ($this->members->removeElement($member)) {
            if ($member->getLineUp() === $this) {
                $member->setLineUp(null);
            }
        }

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
            $registration->setLineUp($this);
        }

        return $this;
    }

    public function removeRegistration(Registration $registration): static
    {
        if ($this->registrations->removeElement($registration)) {
            if ($registration->getLineUp() === $this) {
                $registration->setLineUp(null);
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
            $standing->setLineUp($this);
        }

        return $this;
    }

    public function removeStanding(Standing $standing): static
    {
        if ($this->standings->removeElement($standing)) {
            if ($standing->getLineUp() === $this) {
                $standing->setLineUp(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Fixture>
     */
    public function getFixturesAsA(): Collection
    {
        return $this->fixturesAsA;
    }

    public function addFixtureAsA(Fixture $fixtureAsA): static
    {
        if (!$this->fixturesAsA->contains($fixtureAsA)) {
            $this->fixturesAsA->add($fixtureAsA);
            $fixtureAsA->setLineUpA($this);
        }

        return $this;
    }

    public function removeFixtureAsA(Fixture $fixtureAsA): static
    {
        if ($this->fixturesAsA->removeElement($fixtureAsA)) {
            if ($fixtureAsA->getLineUpA() === $this) {
                $fixtureAsA->setLineUpA(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Fixture>
     */
    public function getFixturesAsB(): Collection
    {
        return $this->fixturesAsB;
    }

    public function addFixtureAsB(Fixture $fixtureAsB): static
    {
        if (!$this->fixturesAsB->contains($fixtureAsB)) {
            $this->fixturesAsB->add($fixtureAsB);
            $fixtureAsB->setLineUpB($this);
        }

        return $this;
    }

    public function removeFixtureAsB(Fixture $fixtureAsB): static
    {
        if ($this->fixturesAsB->removeElement($fixtureAsB)) {
            if ($fixtureAsB->getLineUpB() === $this) {
                $fixtureAsB->setLineUpB(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Fixture>
     */
    public function getForfeitedFixtures(): Collection
    {
        return $this->forfeitedFixtures;
    }

    public function addForfeitedFixture(Fixture $forfeitedFixture): static
    {
        if (!$this->forfeitedFixtures->contains($forfeitedFixture)) {
            $this->forfeitedFixtures->add($forfeitedFixture);
            $forfeitedFixture->setForfeitedByLineUp($this);
        }

        return $this;
    }

    public function removeForfeitedFixture(Fixture $forfeitedFixture): static
    {
        if ($this->forfeitedFixtures->removeElement($forfeitedFixture)) {
            if ($forfeitedFixture->getForfeitedByLineUp() === $this) {
                $forfeitedFixture->setForfeitedByLineUp(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, BracketEntry>
     */
    public function getBracketEntries(): Collection
    {
        return $this->bracketEntries;
    }

    public function addBracketEntry(BracketEntry $bracketEntry): static
    {
        if (!$this->bracketEntries->contains($bracketEntry)) {
            $this->bracketEntries->add($bracketEntry);
            $bracketEntry->setLineUp($this);
        }

        return $this;
    }

    public function removeBracketEntry(BracketEntry $bracketEntry): static
    {
        if ($this->bracketEntries->removeElement($bracketEntry)) {
            if ($bracketEntry->getLineUp() === $this) {
                $bracketEntry->setLineUp(null);
            }
        }

        return $this;
    }
}
