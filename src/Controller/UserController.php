<?php

namespace App\Controller;

use App\Form\ChangePasswordFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="app_user")
     */
    public function user(): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');




        return $this->render('user/user.html.twig');
    }


}

