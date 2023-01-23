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
        //Create an admin User to connect and create new users
        $newUser = new User();
        $newUser->setFirstname('dev');
        $newUser->setLastname('symfony');
        $newUser->setUsername('dev_symfony_1');
        $password = $this->passwordHasher->hashPassword(
            $newUser,
            'password'
        );
        $newUser->setPassword($password);
        $newUser->setPhoneNumber('0122334455');
        $newUser->setRoles(['ROLE_ADMIN']);
        $manager->persist($newUser);
        $manager->flush();
    }
}
