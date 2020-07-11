<?php

namespace App\Controller;

use App\Entity\Etudiants;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\EtudiantsType ;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\EtudiantsRepository;

/**
 * @Route("/etudiants")
 */
class EtudiantsController extends AbstractController
{
    /**
     * @Route("/lists", name="etudiants_index")
     */
    public function index(Request $request,EtudiantsRepository $etu): Response
    {
        $etudinat = new Etudiants();
        $form = $this->createForm(EtudiantsType::class,$etudinat);
        $form->handleRequest($request);
        
        if ($form->isSubmitted()) {
            $etudinat->setMatricule("1452 7384 ABD") ;
            $em = $this->getDoctrine()->getManager() ;
            $em->persist($etudinat);
            $em->flush() ;

            return $this->redirectToRoute('etudiants_index');
        }
        
        $listEtu = $etu->findAll();
        return $this->render('etudiants/index.html.twig', [
            'listEtu' => $listEtu ,
            'form' => $form->createView(),
        ]);
    }
}
