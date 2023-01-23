<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{

    /**
     * Display all users and button to access user's creation
     * @Route("/users", name="app_user", methods={"GET"})
     */
    public function index(UserRepository $userRepository): Response
    {
        $users =$userRepository->findAll();
        return $this->render('user/index.html.twig', [
            'users' => $users,
        ]);
    }

    /**
     * create a user
     * @Route("/user/create", name="user_create", methods={"GET", "POST"})
     */
    public function create(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {

        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $userRepository = $entityManager->getRepository(User::class);
            dump($userRepository->getLastInsertIdForUsername());
            $user->setUsername(
                $user->getFirstname() . '_' .
                $user->getLastname() . '_' .
                $userRepository->getLastInsertIdForUsername()
            );
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_user');
        }

        return $this->render('user/create.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

}
