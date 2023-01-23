<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{

    /**
     * Display the login form
     * @IsGranted("PUBLIC_ACCESS")
     * @Route("/login-form", name="app_login_form", methods={"GET"})
     */
    public function index(): Response
    {
        return $this->render('login/index.html.twig', [
            'last_username' => '',
            'error'         => '',
        ]);
    }

    /**
     * Login a user
     * @Route("/login", name="app_login", methods={"POST"})
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('login/index.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,
        ]);
    }

    /**
     * logout user
     * @IsGranted("ROLE_USER")
     * @Route("/logout", name="app_logout", methods={"GET"})
     */
    public function logout(): RedirectResponse
    {
        return $this->redirect('app_home');
    }
}
