<?php

namespace App\EventListener;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\Security\Http\Event\LoginSuccessEvent;

class LoginSuccessListener
{

    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function __invoke(LoginSuccessEvent $event): void
    {
        /** @var User $user */
        $user = $event->getUser();
        $user->setLastConnexion(new \DateTimeImmutable());
        $this->userRepository->save($user, true);
    }
}