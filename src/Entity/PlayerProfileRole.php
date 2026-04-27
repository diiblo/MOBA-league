<?php

namespace App\Entity;

use App\Enum\PlayerMainRoleEnum;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class PlayerProfileRole
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'roles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?PlayerProfile $playerProfile = null;

    #[ORM\ManyToOne(inversedBy: 'playerProfileRoles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?GameTitle $gameTitle = null;

    #[ORM\Column(enumType: PlayerMainRoleEnum::class)]
    private ?PlayerMainRoleEnum $mainRole = null;

    #[ORM\Column]
    private ?bool $isMain = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getGameTitle(): ?GameTitle
    {
        return $this->gameTitle;
    }

    public function setGameTitle(?GameTitle $gameTitle): static
    {
        $this->gameTitle = $gameTitle;

        return $this;
    }

    public function getMainRole(): ?PlayerMainRoleEnum
    {
        return $this->mainRole;
    }

    public function setMainRole(PlayerMainRoleEnum $mainRole): static
    {
        $this->mainRole = $mainRole;

        return $this;
    }

    public function isMain(): ?bool
    {
        return $this->isMain;
    }

    public function setIsMain(bool $isMain): static
    {
        $this->isMain = $isMain;

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
