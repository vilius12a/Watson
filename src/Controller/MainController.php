<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/contacts", name="contacts")
     */
    public function contacts(): Response
    {
        return $this->render('about/contacts.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    /**
     * @Route("/pricelist", name="pricelist")
     */
    public function pricelist(): Response
    {
        return $this->render('about/pricelist.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    /**
     * @Route("/info", name="info")
     */
    public function info(): Response
    {
        return $this->render('about/info.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }
}