<?php

namespace App\Controller;

use App\Entity\Emplacement;
use App\Entity\Reservation;
use App\Form\EmplacementBackType;
use App\Repository\EmplacementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\TableRepository;
use Doctrine\ORM\EntityManagerInterface;

class EmplacementBackController extends AbstractController
{
    /**
     * @Route("/emplacement/back", name="liste_emplacements")
     */
    public function index(): Response
    {
        $emp= $this->getDoctrine()
            ->getRepository(Emplacement::class)->findAll();
        return $this->render('emplacement_back/index.html.twig',
            array("tabEmp"=>$emp));
    }

    /**
     * @Route("/addEmp", name="addEmp", methods={"GET","POST"})
     */
    public function new(Request $request)
    {
        $emp= new Emplacement();
        $formEmp= $this->createForm(EmplacementBackType::class,$emp);
        $formEmp->handleRequest($request);
        if($formEmp->isSubmitted() && $formEmp->isValid()){
            $em= $this->getDoctrine()->getManager();
            $em->persist($emp);
            $em->flush();
            return $this->redirectToRoute("liste_emplacements", [],Response::HTTP_SEE_OTHER);
        }
        return $this->render("emplacement_back/addEmp.html.twig",array("formEmp"=>$formEmp->createView()));
    }


    /**
     * @Route("/emplacement/updateEmp/{id}",name="updateEmp", methods={"GET","POST"})
     */
    public function update(Request $request,$id)
    {
        $emp= $this->getDoctrine()
            ->getRepository(Emplacement::class)->find($id);
        $formEmp= $this->createForm(EmplacementBackType::class,$emp);
        $formEmp->handleRequest($request);
        if($formEmp->isSubmitted() && $formEmp->isValid()){
            $em= $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute("liste_emplacements");
        }
        return $this->render("emplacement_back/updateEmp.html.twig",
            array("formEmp"=>$formEmp->createView()));
    }


    /**
     * @Route("/supprimer/{id}",name="supprimerEmp")
     */
    public function supprimer(EmplacementRepository $c,$id,EntityManagerInterface $em)
    {

        $emp= $c->find($id);
        $em->remove($emp);
        $em->flush();
        return $this->redirectToRoute("liste_emplacements");
    }




}
