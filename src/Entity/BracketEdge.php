<?php

namespace App\Entity;

use App\Enum\BracketOutcomeEnum;
use App\Enum\BracketSlotEnum;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class BracketEdge
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'outgoingEdges')]
    #[ORM\JoinColumn(nullable: false)]
    private ?BracketNode $fromNode = null;

    #[ORM\ManyToOne(inversedBy: 'incomingEdges')]
    #[ORM\JoinColumn(nullable: false)]
    private ?BracketNode $toNode = null;

    #[ORM\Column(enumType: BracketOutcomeEnum::class)]
    private ?BracketOutcomeEnum $outcome = null;

    #[ORM\Column(enumType: BracketSlotEnum::class)]
    private ?BracketSlotEnum $toSlot = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFromNode(): ?BracketNode
    {
        return $this->fromNode;
    }

    public function setFromNode(?BracketNode $fromNode): static
    {
        $this->fromNode = $fromNode;

        return $this;
    }

    public function getToNode(): ?BracketNode
    {
        return $this->toNode;
    }

    public function setToNode(?BracketNode $toNode): static
    {
        $this->toNode = $toNode;

        return $this;
    }

    public function getOutcome(): ?BracketOutcomeEnum
    {
        return $this->outcome;
    }

    public function setOutcome(BracketOutcomeEnum $outcome): static
    {
        $this->outcome = $outcome;

        return $this;
    }

    public function getToSlot(): ?BracketSlotEnum
    {
        return $this->toSlot;
    }

    public function setToSlot(BracketSlotEnum $toSlot): static
    {
        $this->toSlot = $toSlot;

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
}
