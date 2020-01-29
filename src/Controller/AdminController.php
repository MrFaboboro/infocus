<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Response;

/**
 * @IsGranted("ROLE_ADMIN")
 */
class AdminController extends AbstractController
{
    /**
     * Require ROLE_ADMIN for only this controller
     * @isGranted("ROLE_ADMIN")
     * @Route("/admin", name="admin")
     */
    public function adminDashboard()
    {
        $user = $this->getDoctrine()->getRepository(User::class)->findAll();
        return $this->render('admin/admin.html.twig', ['user' => $user]);
    }

    /**
     * @Route("/admin/promote/{id}", name="user_promote")
     */
    public function promote($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository(User::class)->find($id);

        if (!$user) {
            throw $this->createNotFoundException(
                'Not promoted ' . $id
            );
        }

        $user->setRoles(['ROLE_AUTHOR']);
        $entityManager->flush();

        return $this->redirectToRoute('user_promote', [
            'id' => $user->getId()
        ]);
    }
}
