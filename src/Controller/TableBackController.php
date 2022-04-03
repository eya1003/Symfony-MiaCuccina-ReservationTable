<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TableBackController extends AbstractController
{
    /**
     * @Route("/table/back", name="table_back")
     */
    public function index(): Response
    {
        return $this->render('table_back/index.html.twig', [
            'controller_name' => 'TableBackController',
        ]);
    }
}
