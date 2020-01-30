<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;

class ProfileController extends AbstractController
{
    /**
     * @Route("/profile/{username}", name="user_profile")
     */
    public function userProfile($username)
    {
        $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['username' => $username]);
        return $this->render('profile/profile.html.twig', ['user' => $user]);
    }
}
