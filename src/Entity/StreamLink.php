<?php

namespace App\Entity;

use App\Enum\StreamLanguageEnum;
use App\Enum\StreamPlatformEnum;
use App\Enum\StreamStatusEnum;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class StreamLink
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'streamLinks')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Fixture $fixture = null;

    #[ORM\Column(length: 255)]
    private ?string $url = null;

    #[ORM\Column(enumType: StreamLanguageEnum::class)]
    private ?StreamLanguageEnum $language = null;

    #[ORM\Column(enumType: StreamPlatformEnum::class)]
    private ?StreamPlatformEnum $platform = null;

    #[ORM\Column(enumType: StreamStatusEnum::class)]
    private ?StreamStatusEnum $status = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $startsAt = null;

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

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): static
    {
        $this->url = $url;

        return $this;
    }

    public function getLanguage(): ?StreamLanguageEnum
    {
        return $this->language;
    }

    public function setLanguage(StreamLanguageEnum $language): static
    {
        $this->language = $language;

        return $this;
    }

    public function getPlatform(): ?StreamPlatformEnum
    {
        return $this->platform;
    }

    public function setPlatform(StreamPlatformEnum $platform): static
    {
        $this->platform = $platform;

        return $this;
    }

    public function getStatus(): ?StreamStatusEnum
    {
        return $this->status;
    }

    public function setStatus(StreamStatusEnum $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getStartsAt(): ?\DateTimeImmutable
    {
        return $this->startsAt;
    }

    public function setStartsAt(\DateTimeImmutable $startsAt): static
    {
        $this->startsAt = $startsAt;

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
