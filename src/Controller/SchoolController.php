<?php

namespace App\Controller;

use App\Entity\Process;
use App\Form\ProcessFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SchoolController extends AbstractController
{
    /**
     * @Route("/admin/school", name="school")
     */
    public function index(Request $request)
    {
        $process = new Process();

        $form = $this->createForm(ProcessFormType::class, $process);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($process);
            $em->flush();

            return $this->redirect($this->generateUrl('school'));
        }

        $process = $this->getDoctrine()->getRepository(Process::class)->findAll();
        return $this->render('admin/school.html.twig', ['process' => $process, 'form' => $form->createView()]);
    }

    /**
     * @Route("/admin/school/finish/{id}", name="school_finish")
     */
    public function processFinish($id)
    {
        $em = $this->getDoctrine()->getManager();
        $process = $em->getRepository(Process::class)->find($id);

        if (!$process) {
            throw $this->createNotFoundException(
                'Not finished' . $id
            );
        }
        $process->setFinished(true);
        $em->persist($process);
        $em->flush();

        return $this->redirect($this->generateUrl('school'));
    }
}
