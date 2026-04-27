<?php

namespace App\Entity;

use App\Enum\QualificationSlotTypeEnum;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class QualificationSlot
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'sourceQualificationSlots')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Competition $sourceCompetition = null;

    #[ORM\ManyToOne(inversedBy: 'targetQualificationSlots')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Competition $targetCompetition = null;

    #[ORM\Column]
    private ?int $rankFrom = null;

    #[ORM\Column]
    private ?int $rankTo = null;

    #[ORM\Column(enumType: QualificationSlotTypeEnum::class)]
    private ?QualificationSlotTypeEnum $slotType = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSourceCompetition(): ?Competition
    {
        return $this->sourceCompetition;
    }

    public function setSourceCompetition(?Competition $sourceCompetition): static
    {
        $this->sourceCompetition = $sourceCompetition;

        return $this;
    }

    public function getTargetCompetition(): ?Competition
    {
        return $this->targetCompetition;
    }

    public function setTargetCompetition(?Competition $targetCompetition): static
    {
        $this->targetCompetition = $targetCompetition;

        return $this;
    }

    public function getRankFrom(): ?int
    {
        return $this->rankFrom;
    }

    public function setRankFrom(int $rankFrom): static
    {
        $this->rankFrom = $rankFrom;

        return $this;
    }

    public function getRankTo(): ?int
    {
        return $this->rankTo;
    }

    public function setRankTo(int $rankTo): static
    {
        $this->rankTo = $rankTo;

        return $this;
    }

    public function getSlotType(): ?QualificationSlotTypeEnum
    {
        return $this->slotType;
    }

    public function setSlotType(QualificationSlotTypeEnum $slotType): static
    {
        $this->slotType = $slotType;

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
