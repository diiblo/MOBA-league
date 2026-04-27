<?php

namespace App\Entity;

use App\Enum\FixtureGameWinnerEnum;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Result
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'result')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Fixture $fixture = null;

    #[ORM\Column]
    private ?int $lineUpAScore = null;

    #[ORM\Column]
    private ?int $lineUpBScore = null;

    #[ORM\Column(enumType: FixtureGameWinnerEnum::class)]
    private ?FixtureGameWinnerEnum $winner = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getLineUpAScore(): ?int
    {
        return $this->lineUpAScore;
    }

    public function setLineUpAScore(int $lineUpAScore): static
    {
        $this->lineUpAScore = $lineUpAScore;

        return $this;
    }

    public function getLineUpBScore(): ?int
    {
        return $this->lineUpBScore;
    }

    public function setLineUpBScore(int $lineUpBScore): static
    {
        $this->lineUpBScore = $lineUpBScore;

        return $this;
    }

    public function getWinner(): ?FixtureGameWinnerEnum
    {
        return $this->winner;
    }

    public function setWinner(FixtureGameWinnerEnum $winner): static
    {
        $this->winner = $winner;

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
