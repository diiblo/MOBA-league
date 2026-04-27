<?php

namespace App\Entity;

use App\Enum\UserStatutEnum;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $email = null;

    /**
     * @var list<string>
     */
    #[ORM\Column]
    private array $roles = [];

    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $firstName = null;

    #[ORM\Column(length: 255)]
    private ?string $lastName = null;

    #[ORM\Column]
    private ?bool $isVerified = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $picture = null;

    #[ORM\Column(enumType: UserStatutEnum::class)]
    private ?UserStatutEnum $statut = null;

    #[ORM\Column(length: 255)]
    private ?string $city = null;

    #[ORM\Column(length: 255)]
    private ?string $country = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    /**
     * @var Collection<int, UserPasswordResetToken>
     */
    #[ORM\OneToMany(targetEntity: UserPasswordResetToken::class, mappedBy: 'owner', orphanRemoval: true)]
    private Collection $userPasswordResetTokens;

    /**
     * @var Collection<int, OAuthAccount>
     */
    #[ORM\OneToMany(targetEntity: OAuthAccount::class, mappedBy: 'owner', orphanRemoval: true)]
    private Collection $oAuthAccounts;

    /**
     * @var Collection<int, Notification>
     */
    #[ORM\OneToMany(targetEntity: Notification::class, mappedBy: 'owner', orphanRemoval: true)]
    private Collection $notifications;

    #[ORM\OneToOne(mappedBy: 'owner', cascade: ['persist', 'remove'])]
    private ?PlayerProfile $playerProfile = null;

    /**
     * @var Collection<int, Team>
     */
    #[ORM\OneToMany(targetEntity: Team::class, mappedBy: 'owner')]
    private Collection $teams;

    /**
     * @var Collection<int, Competition>
     */
    #[ORM\OneToMany(targetEntity: Competition::class, mappedBy: 'owner')]
    private Collection $competitions;

    /**
     * @var Collection<int, TeamMember>
     */
    #[ORM\OneToMany(targetEntity: TeamMember::class, mappedBy: 'owner')]
    private Collection $teamMemberships;

    /**
     * @var Collection<int, FixtureGame>
     */
    #[ORM\OneToMany(targetEntity: FixtureGame::class, mappedBy: 'proofUploader')]
    private Collection $uploadedFixtureGames;

    /**
     * @var Collection<int, FixtureGame>
     */
    #[ORM\OneToMany(targetEntity: FixtureGame::class, mappedBy: 'reviewedBy')]
    private Collection $reviewedFixtureGames;

    /**
     * @var Collection<int, Dispute>
     */
    #[ORM\OneToMany(targetEntity: Dispute::class, mappedBy: 'raisedBy')]
    private Collection $raisedDisputes;

    /**
     * @var Collection<int, Dispute>
     */
    #[ORM\OneToMany(targetEntity: Dispute::class, mappedBy: 'resolvedBy')]
    private Collection $resolvedDisputes;

    /**
     * @var Collection<int, FixtureGameStatusHistory>
     */
    #[ORM\OneToMany(targetEntity: FixtureGameStatusHistory::class, mappedBy: 'changedBy')]
    private Collection $fixtureGameStatusChanges;

    /**
     * @var Collection<int, AuditLog>
     */
    #[ORM\OneToMany(targetEntity: AuditLog::class, mappedBy: 'actor')]
    private Collection $auditLogs;

    public function __construct()
    {
        $this->userPasswordResetTokens = new ArrayCollection();
        $this->oAuthAccounts = new ArrayCollection();
        $this->notifications = new ArrayCollection();
        $this->teams = new ArrayCollection();
        $this->competitions = new ArrayCollection();
        $this->teamMemberships = new ArrayCollection();
        $this->uploadedFixtureGames = new ArrayCollection();
        $this->reviewedFixtureGames = new ArrayCollection();
        $this->raisedDisputes = new ArrayCollection();
        $this->resolvedDisputes = new ArrayCollection();
        $this->fixtureGameStatusChanges = new ArrayCollection();
        $this->auditLogs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @return list<string>
     */
    public function getRoles(): array
    {
        return $this->roles;
        //        $roles[] = 'ROLE_USER';
        //
        //        return array_values(array_unique($roles));
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function eraseCredentials(): void
    {
    }

    public function __serialize(): array
    {
        $data = (array) $this;
        $data["\0".self::class."\0password"] = hash('crc32c', (string) $this->password);

        return $data;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function isVerified(): ?bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): static
    {
        $this->isVerified = $isVerified;

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

    public function getStatut(): ?UserStatutEnum
    {
        return $this->statut;
    }

    public function setStatut(UserStatutEnum $statut): static
    {
        $this->statut = $statut;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): static
    {
        $this->country = $country;

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
     * @return Collection<int, UserPasswordResetToken>
     */
    public function getUserPasswordResetTokens(): Collection
    {
        return $this->userPasswordResetTokens;
    }

    public function addUserPasswordResetToken(UserPasswordResetToken $userPasswordResetToken): static
    {
        if (!$this->userPasswordResetTokens->contains($userPasswordResetToken)) {
            $this->userPasswordResetTokens->add($userPasswordResetToken);
            $userPasswordResetToken->setOwner($this);
        }

        return $this;
    }

    public function removeUserPasswordResetToken(UserPasswordResetToken $userPasswordResetToken): static
    {
        if ($this->userPasswordResetTokens->removeElement($userPasswordResetToken)) {
            if ($userPasswordResetToken->getOwner() === $this) {
                $userPasswordResetToken->setOwner(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, OAuthAccount>
     */
    public function getOAuthAccounts(): Collection
    {
        return $this->oAuthAccounts;
    }

    public function addOAuthAccount(OAuthAccount $oAuthAccount): static
    {
        if (!$this->oAuthAccounts->contains($oAuthAccount)) {
            $this->oAuthAccounts->add($oAuthAccount);
            $oAuthAccount->setOwner($this);
        }

        return $this;
    }

    public function removeOAuthAccount(OAuthAccount $oAuthAccount): static
    {
        if ($this->oAuthAccounts->removeElement($oAuthAccount)) {
            if ($oAuthAccount->getOwner() === $this) {
                $oAuthAccount->setOwner(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Notification>
     */
    public function getNotifications(): Collection
    {
        return $this->notifications;
    }

    public function addNotification(Notification $notification): static
    {
        if (!$this->notifications->contains($notification)) {
            $this->notifications->add($notification);
            $notification->setOwner($this);
        }

        return $this;
    }

    public function removeNotification(Notification $notification): static
    {
        if ($this->notifications->removeElement($notification)) {
            if ($notification->getOwner() === $this) {
                $notification->setOwner(null);
            }
        }

        return $this;
    }

    public function getPlayerProfile(): ?PlayerProfile
    {
        return $this->playerProfile;
    }

    public function setPlayerProfile(?PlayerProfile $playerProfile): static
    {
        if (null === $playerProfile && null !== $this->playerProfile) {
            $this->playerProfile->setOwner(null);
        }

        if (null !== $playerProfile && $playerProfile->getOwner() !== $this) {
            $playerProfile->setOwner($this);
        }

        $this->playerProfile = $playerProfile;

        return $this;
    }

    /**
     * @return Collection<int, Team>
     */
    public function getTeams(): Collection
    {
        return $this->teams;
    }

    public function addTeam(Team $team): static
    {
        if (!$this->teams->contains($team)) {
            $this->teams->add($team);
            $team->setOwner($this);
        }

        return $this;
    }

    public function removeTeam(Team $team): static
    {
        if ($this->teams->removeElement($team)) {
            if ($team->getOwner() === $this) {
                $team->setOwner(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Competition>
     */
    public function getCompetitions(): Collection
    {
        return $this->competitions;
    }

    public function addCompetition(Competition $competition): static
    {
        if (!$this->competitions->contains($competition)) {
            $this->competitions->add($competition);
            $competition->setOwner($this);
        }

        return $this;
    }

    public function removeCompetition(Competition $competition): static
    {
        if ($this->competitions->removeElement($competition)) {
            if ($competition->getOwner() === $this) {
                $competition->setOwner(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, TeamMember>
     */
    public function getTeamMemberships(): Collection
    {
        return $this->teamMemberships;
    }

    public function addTeamMembership(TeamMember $teamMembership): static
    {
        if (!$this->teamMemberships->contains($teamMembership)) {
            $this->teamMemberships->add($teamMembership);
            $teamMembership->setOwner($this);
        }

        return $this;
    }

    public function removeTeamMembership(TeamMember $teamMembership): static
    {
        if ($this->teamMemberships->removeElement($teamMembership)) {
            if ($teamMembership->getOwner() === $this) {
                $teamMembership->setOwner(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, FixtureGame>
     */
    public function getUploadedFixtureGames(): Collection
    {
        return $this->uploadedFixtureGames;
    }

    public function addUploadedFixtureGame(FixtureGame $uploadedFixtureGame): static
    {
        if (!$this->uploadedFixtureGames->contains($uploadedFixtureGame)) {
            $this->uploadedFixtureGames->add($uploadedFixtureGame);
            $uploadedFixtureGame->setProofUploader($this);
        }

        return $this;
    }

    public function removeUploadedFixtureGame(FixtureGame $uploadedFixtureGame): static
    {
        if ($this->uploadedFixtureGames->removeElement($uploadedFixtureGame)) {
            if ($uploadedFixtureGame->getProofUploader() === $this) {
                $uploadedFixtureGame->setProofUploader(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, FixtureGame>
     */
    public function getReviewedFixtureGames(): Collection
    {
        return $this->reviewedFixtureGames;
    }

    public function addReviewedFixtureGame(FixtureGame $reviewedFixtureGame): static
    {
        if (!$this->reviewedFixtureGames->contains($reviewedFixtureGame)) {
            $this->reviewedFixtureGames->add($reviewedFixtureGame);
            $reviewedFixtureGame->setReviewedBy($this);
        }

        return $this;
    }

    public function removeReviewedFixtureGame(FixtureGame $reviewedFixtureGame): static
    {
        if ($this->reviewedFixtureGames->removeElement($reviewedFixtureGame)) {
            if ($reviewedFixtureGame->getReviewedBy() === $this) {
                $reviewedFixtureGame->setReviewedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Dispute>
     */
    public function getRaisedDisputes(): Collection
    {
        return $this->raisedDisputes;
    }

    public function addRaisedDispute(Dispute $raisedDispute): static
    {
        if (!$this->raisedDisputes->contains($raisedDispute)) {
            $this->raisedDisputes->add($raisedDispute);
            $raisedDispute->setRaisedBy($this);
        }

        return $this;
    }

    public function removeRaisedDispute(Dispute $raisedDispute): static
    {
        if ($this->raisedDisputes->removeElement($raisedDispute)) {
            if ($raisedDispute->getRaisedBy() === $this) {
                $raisedDispute->setRaisedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Dispute>
     */
    public function getResolvedDisputes(): Collection
    {
        return $this->resolvedDisputes;
    }

    public function addResolvedDispute(Dispute $resolvedDispute): static
    {
        if (!$this->resolvedDisputes->contains($resolvedDispute)) {
            $this->resolvedDisputes->add($resolvedDispute);
            $resolvedDispute->setResolvedBy($this);
        }

        return $this;
    }

    public function removeResolvedDispute(Dispute $resolvedDispute): static
    {
        if ($this->resolvedDisputes->removeElement($resolvedDispute)) {
            if ($resolvedDispute->getResolvedBy() === $this) {
                $resolvedDispute->setResolvedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, FixtureGameStatusHistory>
     */
    public function getFixtureGameStatusChanges(): Collection
    {
        return $this->fixtureGameStatusChanges;
    }

    public function addFixtureGameStatusChange(FixtureGameStatusHistory $fixtureGameStatusChange): static
    {
        if (!$this->fixtureGameStatusChanges->contains($fixtureGameStatusChange)) {
            $this->fixtureGameStatusChanges->add($fixtureGameStatusChange);
            $fixtureGameStatusChange->setChangedBy($this);
        }

        return $this;
    }

    public function removeFixtureGameStatusChange(FixtureGameStatusHistory $fixtureGameStatusChange): static
    {
        if ($this->fixtureGameStatusChanges->removeElement($fixtureGameStatusChange)) {
            if ($fixtureGameStatusChange->getChangedBy() === $this) {
                $fixtureGameStatusChange->setChangedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, AuditLog>
     */
    public function getAuditLogs(): Collection
    {
        return $this->auditLogs;
    }

    public function addAuditLog(AuditLog $auditLog): static
    {
        if (!$this->auditLogs->contains($auditLog)) {
            $this->auditLogs->add($auditLog);
            $auditLog->setActor($this);
        }

        return $this;
    }

    public function removeAuditLog(AuditLog $auditLog): static
    {
        if ($this->auditLogs->removeElement($auditLog)) {
            if ($auditLog->getActor() === $this) {
                $auditLog->setActor(null);
            }
        }

        return $this;
    }
}
