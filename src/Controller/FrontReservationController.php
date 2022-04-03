<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontReservationController extends AbstractController
{
    /**
     * @Route("/front/reservation", name="front_reservation")
     */
    public function index(): Response
    {
        return $this->render('front_reservation/index.html.twig', [
            'controller_name' => 'FrontReservationController',
        ]);
    }
}
