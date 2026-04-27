<?php

namespace App\Entity;

use App\Enum\LineUpMemberRoleEnum;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class LineUpMember
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'members')]
    #[ORM\JoinColumn(nullable: false)]
    private ?LineUp $lineUp = null;

    #[ORM\ManyToOne(inversedBy: 'lineUpMembers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?TeamMember $teamMember = null;

    #[ORM\Column(enumType: LineUpMemberRoleEnum::class)]
    private ?LineUpMemberRoleEnum $role = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getTeamMember(): ?TeamMember
    {
        return $this->teamMember;
    }

    public function setTeamMember(?TeamMember $teamMember): static
    {
        $this->teamMember = $teamMember;

        return $this;
    }

    public function getRole(): ?LineUpMemberRoleEnum
    {
        return $this->role;
    }

    public function setRole(LineUpMemberRoleEnum $role): static
    {
        $this->role = $role;

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
