<?php

namespace App\Controller;

use App\Entity\photo;
use App\Entity\User;
use App\Form\EditProfileType;
use App\Repository\photoRepository;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @IsGranted("IS_AUTHENTICATED_FULLY")
 */
class ProfileController extends AbstractController
{
    /**
     * @Route("/profile", name="profile")
     */
    public function profile(Request $request, GuardAuthenticatorHandler $guardHandler, UserInterface $user): Response
    {
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(EditProfileType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $em->persist($user);
            $em->flush();
        }

        $photos = $user->getPhotos();

        // dd($photos);
        return $this->render('profile/profile.html.twig', [
            'form' => $form->createView(),
            'user' => $user,
        ]);
    }
}
