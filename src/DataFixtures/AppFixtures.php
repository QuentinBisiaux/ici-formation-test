<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;
    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $newUser = new User();
        $newUser->setFirstname('dev');
        $newUser->setLastname('symfony');
        $newUser->setUsername('dev_symfony_1');
        $password = $this->passwordHasher->hashPassword(
            $newUser,
            'password'
        );
        $newUser->setPassword($password);
        $newUser->setPhoneNumber('+33011223344');
        $newUser->setRoles(['ADMIN']);
        $manager->persist($newUser);
        $manager->flush();
    }
}
