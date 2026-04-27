<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class BracketNode
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'nodes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Bracket $bracket = null;

    #[ORM\Column]
    private ?int $roundNumber = null;

    #[ORM\Column]
    private ?int $positionIndex = null;

    #[ORM\OneToOne(inversedBy: 'bracketNode')]
    private ?Fixture $fixture = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    /**
     * @var Collection<int, BracketEntry>
     */
    #[ORM\OneToMany(targetEntity: BracketEntry::class, mappedBy: 'node', orphanRemoval: true)]
    private Collection $entries;

    /**
     * @var Collection<int, BracketEdge>
     */
    #[ORM\OneToMany(targetEntity: BracketEdge::class, mappedBy: 'fromNode', orphanRemoval: true)]
    private Collection $outgoingEdges;

    /**
     * @var Collection<int, BracketEdge>
     */
    #[ORM\OneToMany(targetEntity: BracketEdge::class, mappedBy: 'toNode')]
    private Collection $incomingEdges;

    /**
     * @var Collection<int, BracketEntry>
     */
    #[ORM\OneToMany(targetEntity: BracketEntry::class, mappedBy: 'fromNode')]
    private Collection $entriesFromNode;

    public function __construct()
    {
        $this->entries = new ArrayCollection();
        $this->outgoingEdges = new ArrayCollection();
        $this->incomingEdges = new ArrayCollection();
        $this->entriesFromNode = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBracket(): ?Bracket
    {
        return $this->bracket;
    }

    public function setBracket(?Bracket $bracket): static
    {
        $this->bracket = $bracket;

        return $this;
    }

    public function getRoundNumber(): ?int
    {
        return $this->roundNumber;
    }

    public function setRoundNumber(int $roundNumber): static
    {
        $this->roundNumber = $roundNumber;

        return $this;
    }

    public function getPositionIndex(): ?int
    {
        return $this->positionIndex;
    }

    public function setPositionIndex(int $positionIndex): static
    {
        $this->positionIndex = $positionIndex;

        return $this;
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

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): static
    {
        $this->label = $label;

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
     * @return Collection<int, BracketEntry>
     */
    public function getEntries(): Collection
    {
        return $this->entries;
    }

    public function addEntry(BracketEntry $entry): static
    {
        if (!$this->entries->contains($entry)) {
            $this->entries->add($entry);
            $entry->setNode($this);
        }

        return $this;
    }

    public function removeEntry(BracketEntry $entry): static
    {
        if ($this->entries->removeElement($entry)) {
            if ($entry->getNode() === $this) {
                $entry->setNode(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, BracketEdge>
     */
    public function getOutgoingEdges(): Collection
    {
        return $this->outgoingEdges;
    }

    public function addOutgoingEdge(BracketEdge $outgoingEdge): static
    {
        if (!$this->outgoingEdges->contains($outgoingEdge)) {
            $this->outgoingEdges->add($outgoingEdge);
            $outgoingEdge->setFromNode($this);
        }

        return $this;
    }

    public function removeOutgoingEdge(BracketEdge $outgoingEdge): static
    {
        if ($this->outgoingEdges->removeElement($outgoingEdge)) {
            if ($outgoingEdge->getFromNode() === $this) {
                $outgoingEdge->setFromNode(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, BracketEdge>
     */
    public function getIncomingEdges(): Collection
    {
        return $this->incomingEdges;
    }

    public function addIncomingEdge(BracketEdge $incomingEdge): static
    {
        if (!$this->incomingEdges->contains($incomingEdge)) {
            $this->incomingEdges->add($incomingEdge);
            $incomingEdge->setToNode($this);
        }

        return $this;
    }

    public function removeIncomingEdge(BracketEdge $incomingEdge): static
    {
        if ($this->incomingEdges->removeElement($incomingEdge)) {
            if ($incomingEdge->getToNode() === $this) {
                $incomingEdge->setToNode(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, BracketEntry>
     */
    public function getEntriesFromNode(): Collection
    {
        return $this->entriesFromNode;
    }

    public function addEntriesFromNode(BracketEntry $entriesFromNode): static
    {
        if (!$this->entriesFromNode->contains($entriesFromNode)) {
            $this->entriesFromNode->add($entriesFromNode);
            $entriesFromNode->setFromNode($this);
        }

        return $this;
    }

    public function removeEntriesFromNode(BracketEntry $entriesFromNode): static
    {
        if ($this->entriesFromNode->removeElement($entriesFromNode)) {
            if ($entriesFromNode->getFromNode() === $this) {
                $entriesFromNode->setFromNode(null);
            }
        }

        return $this;
    }
}
