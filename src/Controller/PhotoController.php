<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Foto;
use App\Entity\User;
use App\Form\PhotoUploadType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class PhotoController extends AbstractController
{
    /**
     * @Route("/photos/new", name="photo_new")
     */
    public function upload(Request $request)
    {
        $photo = new Foto();
        $user = $this->getUser();

        $category = $this->getCategories();

        $form = $this->createForm(PhotoUploadType::class, $photo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $photoFile */
            $photoFile = $form->get('fileurl')->getData();

            $category->addPhoto($photo->getId);

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
            $photo->setUser($user)->addCategory($category);

            $em = $this->getDoctrine()->getManager();
            $em->persist($photo);
            $em->flush();

            // go to, in this case, /photos after the photo has been uploaded
            return $this->redirect($this->generateUrl('photo'));
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
        $foto = $this->getDoctrine()->getRepository(Foto::class)->findAll();
        return $this->render('photo/photos.html.twig', ['foto' => $foto]);

        // TODO: categories
    }

    /**
     * @Route("photos/{id}/{slug}", name="actual_photo")
     */
    public function showPhoto($id, UserInterface $user)
    {
        $foto = $this->getDoctrine()->getRepository(Foto::class)->findOneBy([
            'id' => $id
        ]);

        $slug = $foto->getTitel();
        return $this->render('photo/actualphoto.html.twig', [
            'foto' => $foto,
            'user' => $user->getFotos(),
        ]);
    }
}
