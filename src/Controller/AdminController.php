<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\User;
use App\Form\CategoryFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends AbstractController
{
    /**
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

        // dd($user->getRoles());
        $user->setRoles(['ROLE_AUTHOR']);
        $entityManager->flush();

        return $this->redirect($this->generateUrl('admin'));
    }
    /**
     * @Route("/admin/demote/{id}", name="user_demote")
     */
    public function demote($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository(User::class)->find($id);

        if (!$user) {
            throw $this->createNotFoundException(
                'Not demoted ' . $id
            );
        }

        $user->setRoles(['ROLE_USER']);
        $entityManager->flush();

        return $this->redirect($this->generateUrl('admin'));
    }

    /**
     * @Route("/admin/activate/{id}", name="user_activate")
     */
    public function activate($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository(User::class)->find($id);

        if (!$user) {
            throw $this->createNotFoundException(
                'Not promoted ' . $id
            );
        }
        $user->setActive(true);
        $entityManager->flush();

        return $this->redirect($this->generateUrl('admin_users'));
    }
    /**
     * @Route("/admin/deactivate/{id}", name="user_deactivate")
     */
    public function deactivate($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository(User::class)->find($id);

        if (!$user) {
            throw $this->createNotFoundException(
                'Not demoted ' . $id
            );
        }
        $user->setActive(false);
        $entityManager->flush();

        return $this->redirect($this->generateUrl('admin_users'));
    }

    /**
     * @Route("/admin/users", name="admin_users")
     */
    public function users()
    {
        $user = $this->getDoctrine()->getRepository(User::class)->findAll();
        return $this->render('admin/users.html.twig', ['user' => $user]);
    }

    /**
     * @Route("/admin/categories", name="admin_categories")
     */
    public function admCat(Request $request)
    {
        $category = new Category();

        $form = $this->createForm(CategoryFormType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_categories'));
        }

        $category = $this->getDoctrine()->getRepository(Category::class)->findAll();
        return $this->render('admin/category.html.twig', ['category' => $category, 'form' => $form->createView()]);
    }
    /**
     * @Route("/admin/categories/delete/{id}", name="admin_cat_delete")
     */
    public function rmCat($id)
    {
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository(Category::class)->find($id);

        if (!$category) {
            throw $this->createNotFoundException(
                'Not deleted ' . $id
            );
        }
        $em->remove($category);
        $em->flush();

        return $this->redirect($this->generateUrl('admin_categories'));
    }
}
