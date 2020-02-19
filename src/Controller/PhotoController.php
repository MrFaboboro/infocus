<?php

namespace App\Controller;

use App\Entity\Photo;
use App\Entity\User;
use App\Entity\Category;
use App\Form\PhotoUploadType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Security\Core\User\UserInterface;

class PhotoController extends AbstractController
{
    /**
     * @Security("is_granted('ROLE_ADMIN') or is_granted('ROLE_AUTHOR') or is_granted('ROLE_SUPER_ADMIN')")
     * @Route("/photos/new", name="photo_new")
     */
    public function upload(Request $request)
    {
        $photo = new Photo();
        $user = $this->getUser();

        $form = $this->createForm(PhotoUploadType::class, $photo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $photoFile = $form->get('fileurl')->getData();
            // file rename
            if ($photoFile) {
                // hash file name for unique id
                $newFileName = md5(uniqid()) . '.' . $photoFile->guessExtension();

                // save image or throw error
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
        // show all photos on the page
        $photo = $this->getDoctrine()->getRepository(Photo::class)->findAll();
        $categories = $this->getDoctrine()->getRepository(Category::class)->findAll();
        return $this->render('photo/photos.html.twig', ['photo' => $photo, 'categories' => $categories]);
    }

    /**
     * @Route("photos/{id}/{slug}", name="actual_photo")
     */
    public function showPhoto($id)
    {
        $photo = $this->getDoctrine()->getRepository(Photo::class)->findOneBy([
            'id' => $id
        ]);

        $slug = $photo->getTitle();
        return $this->render('photo/actualphoto.html.twig', [
            'photo' => $photo,
        ]);
    }
}
