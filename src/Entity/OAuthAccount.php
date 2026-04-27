<?php

namespace App\Entity;

use App\Enum\OAuthProviderEnum;
use App\Repository\OAuthAccountRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OAuthAccountRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_OAUTH_PROVIDER_USER', fields: ['provider', 'providerUserId'])]
class OAuthAccount
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'oAuthAccounts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $owner = null;

    #[ORM\Column(enumType: OAuthProviderEnum::class)]
    private ?OAuthProviderEnum $provider = null;

    #[ORM\Column(length: 255)]
    private ?string $providerUserId = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $providerEmail = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getProvider(): ?OAuthProviderEnum
    {
        return $this->provider;
    }

    public function setProvider(OAuthProviderEnum $provider): static
    {
        $this->provider = $provider;

        return $this;
    }

    public function getProviderUserId(): ?string
    {
        return $this->providerUserId;
    }

    public function setProviderUserId(string $providerUserId): static
    {
        $this->providerUserId = $providerUserId;

        return $this;
    }

    public function getProviderEmail(): ?string
    {
        return $this->providerEmail;
    }

    public function setProviderEmail(?string $providerEmail): static
    {
        $this->providerEmail = $providerEmail;

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
