<?php

namespace App\Controller;

use App\Entity\Emplacement;
use App\Repository\EmplacementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class EmplacementJSONController extends AbstractController
{
    /**
     * @Route("/emplacement/j/s/o/n", name="emplacement_j_s_o_n")
     */
    public function index(): Response
    {
        return $this->render('emplacement_json/index.html.twig', [
            'controller_name' => 'EmplacementJSONController',
        ]);
    }

    /**
     * @Route("/api/afficheEmp", name="api_afficheEmp")
     */
    public function AfficheApi(EmplacementRepository $repo,NormalizerInterface $Normalizer) {
        $agence=$this->getDoctrine()->getRepository(Emplacement::class)->findAll();

        $jsonContent=$Normalizer->normalize($agence,'json',['groups'=>'post:read']);


        return new Response(json_encode($jsonContent));

    }
    /**
     * @Route("/addEmpJSON", name="Emplacement")
     */
    public function newEmp(Request $request,NormalizerInterface  $normalizer)
    {
        $em= $this->getDoctrine()->getManager();
        $emp= new Emplacement();
        $emp->setTypeEmplacement($request->get('type_emplacement'));
        $emp->setDescription($request->get('Description'));
        $em->persist($emp);
        $em->flush();
        $jsonContent =$normalizer->normalize($emp,'json',['groups'=>'post:read']);
        return new Response(json_encode($jsonContent));
    }


    /**
     * @Route("/emplacement/updateEmplacement/{id}",name="updateEmp", methods={"GET","POST"})
     */
    public function update(Request $request,$id,NormalizerInterface  $normalizer)
    {
        $em= $this->getDoctrine()->getManager();
        $emp= $this->getDoctrine()
            ->getRepository(Emplacement::class)->find($id);

        $emp->setTypeEmplacement($request->get('type_emplacement'));
        $emp->setDescription($request->get('Description'));
        $em->flush();
        $jsonContent =$normalizer->normalize($emp,'json',['groups'=>'post:read']);
        return new Response("Information updated successfully".json_encode($jsonContent));
    }

    /**
     * @Route("/supprimerEmp/{id}",name="supprimerEmp")
     */
    public function supprimer(Request $request, NormalizerInterface  $normalizer, $id)

    {
        $em = $this -> getDoctrine() -> getManager();
        $emplacement = $em -> getRepository(Emplacement::class) -> find($id);
        $em -> remove($emplacement);
        $em -> flush();
        $jsonContent = $normalizer -> normalize($emplacement, 'json', ['groups' => 'post:read']);
        return new Response("Information deleted successfully" . json_encode($jsonContent));


    }
}
