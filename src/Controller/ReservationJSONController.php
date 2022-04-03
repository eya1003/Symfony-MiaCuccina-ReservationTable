<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Repository\ReservationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class ReservationJSONController extends AbstractController
{
    /**
     * @Route("/reservation/j/s/o/n", name="reservation_j_s_o_n")
     */
    public function index(): Response
    {
        return $this->render('reservation_json/index.html.twig', [
            'controller_name' => 'ReservationJSONController',
        ]);
    }
    /**
     * @Route ("/AllResv", name="AllResv")
     */
    public function AllResv(ReservationRepository $repo,NormalizerInterface $Normalizer)
    {

        $reservation=$this->getDoctrine()->getRepository(Reservation::class)->findAll();

        $jsonContent=$Normalizer->normalize($reservation,'json',['groups'=>'post:read']);


        return new Response(json_encode($jsonContent));

    }


    /**
     * @Route("/addResvJSON", name="Resv")
     * @Method("POST")
     */
    public function newResv(Request $request,NormalizerInterface  $normalizer)
    {
        $reservation = new Reservation();
        $phone= $request->query->get("phone_resv");
        $email = $request->query->get("Email_resv");
        $em = $this->getDoctrine()->getManager();
        $date = new \DateTime('now');
        $datEnd = new \DateTime('now+1 hour');



        $reservation->setDateResv($date);
        $reservation->setEndResv($datEnd);
        $reservation->setPhoneResv($phone);
        $reservation->setEmailResv($email);

        $em->persist($reservation);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $jsonContent =$normalizer->normalize($reservation,'json',['groups'=>'post:read']);
        return new Response(json_encode($jsonContent));
    }

    /**
     * @Route("/supprimerResv/{id}",name="supprimerReservation")
     */
    public function supprimerMobile(Request $request, NormalizerInterface  $normalizer, $id)

    {
        $em = $this -> getDoctrine() -> getManager();
        $resv = $em -> getRepository(Reservation::class) -> find($id);
        $em -> remove($resv);
        $em -> flush();
        $jsonContent = $normalizer -> normalize($resv, 'json', ['groups' => 'post:read']);
        return new Response("Reservation deleted successfully" . json_encode($jsonContent));


    }

    /**
     * @Route("/reserupdate/{id}",name="updateResv", methods={"GET","POST"})
     */
    public function updateJSONMobile(Request $request,$id,NormalizerInterface  $normalizer)
    {
        $em= $this->getDoctrine()->getManager();
        $emp= $this->getDoctrine()
            ->getRepository(Reservation::class)->find($id);

        $emp->setPhoneResv($request->get('phone_resv'));
        $emp->setEmailResv($request->get('Email_resv'));
        $em->flush();
        $jsonContent =$normalizer->normalize($emp,'json',['groups'=>'post:read']);
        return new Response("Information updated successfully".json_encode($jsonContent));
    }

}
