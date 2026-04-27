<?php

namespace App\Service;

use App\Repository\UserRepository;
use App\Security\EmailVerifier;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

readonly class UserEmailVerificationService
{
    public function __construct(
        private EmailVerifier $emailVerifier,
        private UserRepository $userRepository,
    ) {
    }

    /**
     * @throws VerifyEmailExceptionInterface
     */
    public function verifyFromRequest(Request $request): void
    {
        $id = $request->query->getInt('id');

        if ($id <= 0) {
            throw new UserNotFoundException();
        }

        $user = $this->userRepository->find($id);

        if (!$user) {
            throw new UserNotFoundException();
        }

        // validate email confirmation link, sets User::isVerified=true and persists
        $this->emailVerifier->handleEmailConfirmation($request, $user);
    }
}
