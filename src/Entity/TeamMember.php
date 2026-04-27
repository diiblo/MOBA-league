<?php

namespace App\Entity;

use App\Enum\TeamMemberRoleEnum;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class TeamMember
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'members')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Team $team = null;

    #[ORM\ManyToOne(inversedBy: 'teamMemberships')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $owner = null;

    #[ORM\Column(enumType: TeamMemberRoleEnum::class)]
    private ?TeamMemberRoleEnum $role = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $joinedAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    /**
     * @var Collection<int, LineUpMember>
     */
    #[ORM\OneToMany(targetEntity: LineUpMember::class, mappedBy: 'teamMember')]
    private Collection $lineUpMembers;

    public function __construct()
    {
        $this->lineUpMembers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTeam(): ?Team
    {
        return $this->team;
    }

    public function setTeam(?Team $team): static
    {
        $this->team = $team;

        return $this;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): static
    {
        $this->owner = $owner;

        return $this;
    }

    public function getRole(): ?TeamMemberRoleEnum
    {
        return $this->role;
    }

    public function setRole(TeamMemberRoleEnum $role): static
    {
        $this->role = $role;

        return $this;
    }

    public function getJoinedAt(): ?\DateTimeImmutable
    {
        return $this->joinedAt;
    }

    public function setJoinedAt(\DateTimeImmutable $joinedAt): static
    {
        $this->joinedAt = $joinedAt;

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
     * @return Collection<int, LineUpMember>
     */
    public function getLineUpMembers(): Collection
    {
        return $this->lineUpMembers;
    }

    public function addLineUpMember(LineUpMember $lineUpMember): static
    {
        if (!$this->lineUpMembers->contains($lineUpMember)) {
            $this->lineUpMembers->add($lineUpMember);
            $lineUpMember->setTeamMember($this);
        }

        return $this;
    }

    public function removeLineUpMember(LineUpMember $lineUpMember): static
    {
        if ($this->lineUpMembers->removeElement($lineUpMember)) {
            if ($lineUpMember->getTeamMember() === $this) {
                $lineUpMember->setTeamMember(null);
            }
        }

        return $this;
    }
}
