<?php

namespace App\Service;

use App\Dto\UserRegistrationDto;
use App\Entity\User;
use App\Enum\UserStatutEnum;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

readonly class UserRegistrationService
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private UserPasswordHasherInterface $userPasswordHasher,
    ) {
    }

    public function register(UserRegistrationDto $data): User
    {
        $user = new User();
        $user->setEmail($data->email);
        $user->setFirstName($data->firstName);
        $user->setLastName($data->lastName);
        $user->setCity($data->city);
        $user->setCountry($data->country);
        $user->setRoles(['ROLE_USER']);
        $user->setIsVerified(false);
        $user->setStatut(UserStatutEnum::ACTIVE);
        $user->setCreatedAt(new \DateTimeImmutable());
        $user->setUpdatedAt(new \DateTimeImmutable());

        // encode the plain password
        $user->setPassword($this->userPasswordHasher->hashPassword($user, $data->plainPassword));

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $user;
    }
}
