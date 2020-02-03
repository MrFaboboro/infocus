<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class Controller extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        $user = $this->getDoctrine()->getRepository(User::class);
        return $this->render('home/index.html.twig', ['user', $user]);
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact()
    {
        return $this->render('contact/contact.html.twig');
    }

    /**
     * @Route("/projecten", name="projecten")
     */
    public function projecten()
    {
        return $this->render('project/projecten.html.twig');
    }

    /**
     * @Route("/foto", name="foto")
     */
    public function foto()
    {
        return $this->render('foto/foto.html.twig');
    }
}
