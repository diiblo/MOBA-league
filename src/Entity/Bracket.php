<?php

namespace App\Entity;

use App\Enum\BracketSeedingModeEnum;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Bracket
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'bracket')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Competition $competition = null;

    #[ORM\Column]
    private ?int $size = null;

    #[ORM\Column(enumType: BracketSeedingModeEnum::class)]
    private ?BracketSeedingModeEnum $seedingMode = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $generatedAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    /**
     * @var Collection<int, BracketNode>
     */
    #[ORM\OneToMany(targetEntity: BracketNode::class, mappedBy: 'bracket', orphanRemoval: true)]
    private Collection $nodes;

    public function __construct()
    {
        $this->nodes = new ArrayCollection();
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

    public function getSize(): ?int
    {
        return $this->size;
    }

    public function setSize(int $size): static
    {
        $this->size = $size;

        return $this;
    }

    public function getSeedingMode(): ?BracketSeedingModeEnum
    {
        return $this->seedingMode;
    }

    public function setSeedingMode(BracketSeedingModeEnum $seedingMode): static
    {
        $this->seedingMode = $seedingMode;

        return $this;
    }

    public function getGeneratedAt(): ?\DateTimeImmutable
    {
        return $this->generatedAt;
    }

    public function setGeneratedAt(\DateTimeImmutable $generatedAt): static
    {
        $this->generatedAt = $generatedAt;

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
     * @return Collection<int, BracketNode>
     */
    public function getNodes(): Collection
    {
        return $this->nodes;
    }

    public function addNode(BracketNode $node): static
    {
        if (!$this->nodes->contains($node)) {
            $this->nodes->add($node);
            $node->setBracket($this);
        }

        return $this;
    }

    public function removeNode(BracketNode $node): static
    {
        if ($this->nodes->removeElement($node)) {
            if ($node->getBracket() === $this) {
                $node->setBracket(null);
            }
        }

        return $this;
    }
}
