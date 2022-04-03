<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PIController extends AbstractController
{
    /**
     * @Route("/p/i", name="p_i")
     */
    public function index(): Response
    {
        return $this->render('pi/index.html.twig', [
            'controller_name' => 'PIController',
        ]);
    }
}
