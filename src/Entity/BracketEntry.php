<?php

namespace App\Entity;

use App\Enum\BracketEntryTypeEnum;
use App\Enum\BracketOutcomeEnum;
use App\Enum\BracketSlotEnum;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class BracketEntry
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'entries')]
    #[ORM\JoinColumn(nullable: false)]
    private ?BracketNode $node = null;

    #[ORM\Column(enumType: BracketSlotEnum::class)]
    private ?BracketSlotEnum $slot = null;

    #[ORM\Column(enumType: BracketEntryTypeEnum::class)]
    private ?BracketEntryTypeEnum $entryType = null;

    #[ORM\ManyToOne(inversedBy: 'bracketEntries')]
    private ?LineUp $lineUp = null;

    #[ORM\ManyToOne(inversedBy: 'entriesFromNode')]
    private ?BracketNode $fromNode = null;

    #[ORM\Column(enumType: BracketOutcomeEnum::class)]
    private ?BracketOutcomeEnum $fromOutcome = null;

    #[ORM\Column(nullable: true)]
    private ?int $seed = null;

    #[ORM\Column]
    private ?bool $isBye = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNode(): ?BracketNode
    {
        return $this->node;
    }

    public function setNode(?BracketNode $node): static
    {
        $this->node = $node;

        return $this;
    }

    public function getSlot(): ?BracketSlotEnum
    {
        return $this->slot;
    }

    public function setSlot(BracketSlotEnum $slot): static
    {
        $this->slot = $slot;

        return $this;
    }

    public function getEntryType(): ?BracketEntryTypeEnum
    {
        return $this->entryType;
    }

    public function setEntryType(BracketEntryTypeEnum $entryType): static
    {
        $this->entryType = $entryType;

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

    public function getFromNode(): ?BracketNode
    {
        return $this->fromNode;
    }

    public function setFromNode(?BracketNode $fromNode): static
    {
        $this->fromNode = $fromNode;

        return $this;
    }

    public function getFromOutcome(): ?BracketOutcomeEnum
    {
        return $this->fromOutcome;
    }

    public function setFromOutcome(BracketOutcomeEnum $fromOutcome): static
    {
        $this->fromOutcome = $fromOutcome;

        return $this;
    }

    public function getSeed(): ?int
    {
        return $this->seed;
    }

    public function setSeed(?int $seed): static
    {
        $this->seed = $seed;

        return $this;
    }

    public function isBye(): ?bool
    {
        return $this->isBye;
    }

    public function setIsBye(bool $isBye): static
    {
        $this->isBye = $isBye;

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
