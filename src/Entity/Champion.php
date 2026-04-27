<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Champion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'champions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?GameTitle $gameTitle = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $picture = null;

    #[ORM\Column]
    private ?bool $isActive = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    /**
     * @var Collection<int, PlayerGameStat>
     */
    #[ORM\OneToMany(targetEntity: PlayerGameStat::class, mappedBy: 'champion')]
    private Collection $playerGameStats;

    public function __construct()
    {
        $this->playerGameStats = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGameTitle(): ?GameTitle
    {
        return $this->gameTitle;
    }

    public function setGameTitle(?GameTitle $gameTitle): static
    {
        $this->gameTitle = $gameTitle;

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

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): static
    {
        $this->picture = $picture;

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): static
    {
        $this->isActive = $isActive;

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
     * @return Collection<int, PlayerGameStat>
     */
    public function getPlayerGameStats(): Collection
    {
        return $this->playerGameStats;
    }

    public function addPlayerGameStat(PlayerGameStat $playerGameStat): static
    {
        if (!$this->playerGameStats->contains($playerGameStat)) {
            $this->playerGameStats->add($playerGameStat);
            $playerGameStat->setChampion($this);
        }

        return $this;
    }

    public function removePlayerGameStat(PlayerGameStat $playerGameStat): static
    {
        if ($this->playerGameStats->removeElement($playerGameStat)) {
            if ($playerGameStat->getChampion() === $this) {
                $playerGameStat->setChampion(null);
            }
        }

        return $this;
    }
}
