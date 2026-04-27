<?php

namespace App\Entity;

use App\Enum\FixtureGameStatusEnum;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class FixtureGameStatusHistory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'statusHistory')]
    #[ORM\JoinColumn(nullable: false)]
    private ?FixtureGame $fixtureGame = null;

    #[ORM\ManyToOne(inversedBy: 'fixtureGameStatusChanges')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $changedBy = null;

    #[ORM\Column(enumType: FixtureGameStatusEnum::class)]
    private ?FixtureGameStatusEnum $fromStatus = null;

    #[ORM\Column(enumType: FixtureGameStatusEnum::class)]
    private ?FixtureGameStatusEnum $toStatus = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $reason = null;

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

    public function getChangedBy(): ?User
    {
        return $this->changedBy;
    }

    public function setChangedBy(?User $changedBy): static
    {
        $this->changedBy = $changedBy;

        return $this;
    }

    public function getFromStatus(): ?FixtureGameStatusEnum
    {
        return $this->fromStatus;
    }

    public function setFromStatus(FixtureGameStatusEnum $fromStatus): static
    {
        $this->fromStatus = $fromStatus;

        return $this;
    }

    public function getToStatus(): ?FixtureGameStatusEnum
    {
        return $this->toStatus;
    }

    public function setToStatus(FixtureGameStatusEnum $toStatus): static
    {
        $this->toStatus = $toStatus;

        return $this;
    }

    public function getReason(): ?string
    {
        return $this->reason;
    }

    public function setReason(?string $reason): static
    {
        $this->reason = $reason;

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
