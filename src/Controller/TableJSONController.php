<?php

namespace App\Controller;

use App\Entity\Table;
use App\Repository\TableRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class TableJSONController extends AbstractController
{
    /**
     * @Route("/table/j/s/o/n", name="table_j_s_o_n")
     */
    public function index(): Response
    {
        return $this->render('table_json/index.html.twig', [
            'controller_name' => 'TableJSONController',
        ]);
    }

    /**
     * @Route("/mobile/affTable", name="affTable")
     */
    public function affTable(TableRepository $repo,NormalizerInterface $Normalizer) {

        $table=$this->getDoctrine()->getRepository(Table::class)->findAll();
        $jsonContent=$Normalizer->normalize($table,'json',['groups'=>'post:read']);
        return new Response(json_encode($jsonContent));

    }


    /**
     * @Route("/table/supprimer/{id}",name="supprimerTab")
     */
    public function supprimer(TableRepository $c,$id,EntityManagerInterface $em,NormalizerInterface  $normalizer)
    {
        $emp= $c->find($id);
        $em->remove($emp);
        $em->flush();
        $jsonContent =$normalizer->normalize($emp,'json',['groups'=>'post:read']);
        return new Response("Information deleted successfully".json_encode($jsonContent));
    }
}
