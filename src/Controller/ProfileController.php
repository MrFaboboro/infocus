<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Repository\UserRepository;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;

/**
 * @IsGranted("IS_AUTHENTICATED_FULLY")
 */
class ProfileController extends AbstractController
{
    /**
     * @Route("/profile", name="user_profile")
     */
    public function userProfile(UserInterface $user)
    {
        // get userdata
        $userId = $user->getId();
        $userName = $user->getUsername();
        $userEmail = $user->getEmail();
        $userAge = $user->getAge();
        $userRole = $user->getRoles();

        // send userdata to profile.html.twig
        return $this->render('profile/profile.html.twig', [
            'userId' => $userId,
            'userName' => $userName,
            'userEmail' => $userEmail,
            'userAge' => $userAge,
            'userRole' => $userRole,
        ]);
    }


    /**
     * @Route("/profile/edit/{id}")
     */
    public function editProfile($id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)->find($id);

        if (!$user) {
            throw $this->createNotFoundException(
                $e . 'Profile not edited ' . $id
            );
        }

        $user->setUsername($request->username)
            ->setEmail($request->email);
        $em->flush();

        return $this->render('profile/profile.html.twig');
    }
}
