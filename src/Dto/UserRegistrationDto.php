<?php

namespace App\Dto;

use App\Validator\EmailConstraint;
use Symfony\Component\Validator\Constraints as Assert;

class UserRegistrationDto
{
    #[Assert\NotBlank]
    #[Assert\Email]
    #[EmailConstraint]
    public string $email = '';

    #[Assert\NotBlank]
    #[Assert\Length(min: 2, max: 255)]
    public string $firstName = '';

    #[Assert\NotBlank]
    #[Assert\Length(min: 2, max: 255)]
    public string $lastName = '';

    #[Assert\NotBlank]
    #[Assert\Length(min: 2, max: 255)]
    public string $city = '';

    #[Assert\NotBlank]
    #[Assert\Length(min: 2, max: 255)]
    public string $country = '';

    #[Assert\NotBlank]
    #[Assert\Length(min: 6, max: 4096)]
    public string $plainPassword = '';

    #[Assert\NotBlank]
    #[Assert\Length(min: 6, max: 4096)]
    #[Assert\EqualTo(propertyPath: 'plainPassword', message: 'Les mots de passe ne correspondent pas.')]
    public string $repeatPassword = '';

    #[Assert\IsTrue(message: 'Vous devez accepter les conditions d\'utilisation.')]
    public bool $agreeTerms = false;
}
