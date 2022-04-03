<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReservationBackController extends AbstractController
{
    /**
     * @Route("/reservation/back", name="reservation_back")
     */
    public function index(): Response
    {
        return $this->render('reservation_back/index.html.twig', [
            'controller_name' => 'ReservationBackController',
        ]);
    }
}
