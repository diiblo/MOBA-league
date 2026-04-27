<?php

namespace App\Controller\Auth;

use App\Dto\UserRegistrationDto;
use App\Form\RegistrationFormType;
use App\Service\EmailService;
use App\Service\UserEmailVerificationService;
use App\Service\UserRegistrationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use Symfony\Contracts\Translation\TranslatorInterface;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

class RegistrationController extends AbstractController
{
    public function __construct(
        private readonly EmailService $emailService,
        private readonly UserRegistrationService $userRegistrationService,
        private readonly UserEmailVerificationService $userEmailVerificationService,
    ) {
    }

    #[Route('/register', name: 'app_register')]
    public function register(Request $request): Response
    {
        $dto = new UserRegistrationDto();
        $form = $this->createForm(RegistrationFormType::class, $dto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->userRegistrationService->register($form->getData());

            $this->emailService->sendEmailRegistrationConfirmation($user);

            return $this->redirectToRoute('app_login');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form,
        ]);
    }

    #[Route('/verify/email', name: 'app_verify_email')]
    public function verifyUserEmail(Request $request, TranslatorInterface $translator): Response
    {
        try {
            $this->userEmailVerificationService->verifyFromRequest($request);
            $this->addFlash('success', 'Your email address has been verified.');

            return $this->redirectToRoute('app_login');
        } catch (UserNotFoundException) {
            return $this->redirectToRoute('app_register');
        } catch (VerifyEmailExceptionInterface $exception) {
            $this->addFlash('verify_email_error', $translator->trans($exception->getReason(), [], 'VerifyEmailBundle'));

            return $this->redirectToRoute('app_login');
        }
    }
}
