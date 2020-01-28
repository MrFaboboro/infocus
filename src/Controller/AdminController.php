<?php

namespace App\Controller;

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
        return $this->render('admin/index.html.twig');
    }
}
