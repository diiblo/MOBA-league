<?php

namespace App\Entity;

use App\Enum\DisputeStatusEnum;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Dispute
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'disputes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?FixtureGame $fixtureGame = null;

    #[ORM\ManyToOne(inversedBy: 'raisedDisputes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $raisedBy = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $reason = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $evidenceUrl = null;

    #[ORM\Column(enumType: DisputeStatusEnum::class)]
    private ?DisputeStatusEnum $status = null;

    #[ORM\ManyToOne(inversedBy: 'resolvedDisputes')]
    private ?User $resolvedBy = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $resolution = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $resolvedAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFixtureGame(): ?FixtureGame
    {
        return $this->fixtureGame;
    }

    public function setFixtureGame(?FixtureGame $fixtureGame): static
    {
        $this->fixtureGame = $fixtureGame;

        return $this;
    }

    public function getRaisedBy(): ?User
    {
        return $this->raisedBy;
    }

    public function setRaisedBy(?User $raisedBy): static
    {
        $this->raisedBy = $raisedBy;

        return $this;
    }

    public function getReason(): ?string
    {
        return $this->reason;
    }

    public function setReason(string $reason): static
    {
        $this->reason = $reason;

        return $this;
    }

    public function getEvidenceUrl(): ?string
    {
        return $this->evidenceUrl;
    }

    public function setEvidenceUrl(?string $evidenceUrl): static
    {
        $this->evidenceUrl = $evidenceUrl;

        return $this;
    }

    public function getStatus(): ?DisputeStatusEnum
    {
        return $this->status;
    }

    public function setStatus(DisputeStatusEnum $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getResolvedBy(): ?User
    {
        return $this->resolvedBy;
    }

    public function setResolvedBy(?User $resolvedBy): static
    {
        $this->resolvedBy = $resolvedBy;

        return $this;
    }

    public function getResolution(): ?string
    {
        return $this->resolution;
    }

    public function setResolution(?string $resolution): static
    {
        $this->resolution = $resolution;

        return $this;
    }

    public function getResolvedAt(): ?\DateTimeImmutable
    {
        return $this->resolvedAt;
    }

    public function setResolvedAt(?\DateTimeImmutable $resolvedAt): static
    {
        $this->resolvedAt = $resolvedAt;

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
