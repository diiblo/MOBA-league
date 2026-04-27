<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class PlayerGameStat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'playerGameStats')]
    #[ORM\JoinColumn(nullable: false)]
    private ?FixtureGame $fixtureGame = null;

    #[ORM\ManyToOne(inversedBy: 'playerGameStats')]
    #[ORM\JoinColumn(nullable: false)]
    private ?PlayerProfile $playerProfile = null;

    #[ORM\ManyToOne(inversedBy: 'playerGameStats')]
    private ?Champion $champion = null;

    #[ORM\Column]
    private ?int $kills = null;

    #[ORM\Column]
    private ?int $deaths = null;

    #[ORM\Column]
    private ?int $assists = null;

    #[ORM\Column(nullable: true)]
    private ?int $cs = null;

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

    public function getPlayerProfile(): ?PlayerProfile
    {
        return $this->playerProfile;
    }

    public function setPlayerProfile(?PlayerProfile $playerProfile): static
    {
        $this->playerProfile = $playerProfile;

        return $this;
    }

    public function getChampion(): ?Champion
    {
        return $this->champion;
    }

    public function setChampion(?Champion $champion): static
    {
        $this->champion = $champion;

        return $this;
    }

    public function getKills(): ?int
    {
        return $this->kills;
    }

    public function setKills(int $kills): static
    {
        $this->kills = $kills;

        return $this;
    }

    public function getDeaths(): ?int
    {
        return $this->deaths;
    }

    public function setDeaths(int $deaths): static
    {
        $this->deaths = $deaths;

        return $this;
    }

    public function getAssists(): ?int
    {
        return $this->assists;
    }

    public function setAssists(int $assists): static
    {
        $this->assists = $assists;

        return $this;
    }

    public function getCs(): ?int
    {
        return $this->cs;
    }

    public function setCs(?int $cs): static
    {
        $this->cs = $cs;

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
