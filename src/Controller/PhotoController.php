<?php

namespace App\Controller;

use App\Entity\Foto;
use App\Entity\User;
use App\Form\PhotoUploadType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PhotoController extends AbstractController
{
    /**
     * @Route("/photos/new", name="photo_new")
     */
    public function upload(Request $request)
    {
        $photo = new Foto();
        $user = $this->getUser();

        $form = $this->createForm(PhotoUploadType::class, $photo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $photoFile */
            $photoFile = $form->get('fileurl')->getData();


            // file rename
            if ($photoFile) {
                // hash file name for unique id
                $newFileName = md5(uniqid()) . '.' . $photoFile->guessExtension();

                // save image
                try {
                    $photoFile->move(
                        $this->getParameter('img/uploaded'),
                        $newFileName
                    );
                } catch (FileException $e) {
                    return $e;
                }

                // set data in database
                $photo->setFileurl($newFileName);
            }
            $photo->setUser($user);

            $em = $this->getDoctrine()->getManager();
            $em->persist($photo);
            $em->flush();

            return $this->redirect($this->generateUrl('home'));
        }

        return $this->render('photo/upload.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("photos", name="photo")
     */
    public function showPage()
    {
        $photo = $this->getDoctrine()->getRepository(Foto::class)->findAll();
        return $this->render('photo/photos.html.twig', ['photo' => $photo]);
    }

    /**
     * @Route("photos/{slug}")
     */
    public function showRedirect($slug)
    {
    }
}
