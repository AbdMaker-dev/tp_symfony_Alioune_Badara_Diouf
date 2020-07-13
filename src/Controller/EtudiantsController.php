<?php

namespace App\Controller;

use App\Entity\Etudiants;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\EtudiantsType ;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\EtudiantsRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Constraints\Json;

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


    /**
     * Get all regions by Country (Ajax)
     * 
     * @Route("/recherche", name="etudiants_recherche", methods={"POST"})
     * 
    */
    
    public function recherche(Request $request,SerializerInterface $sriz,EtudiantsRepository $etuRip)
    {
        $result = [] ;
        if($request->isXmlHttpRequest()){
            if(!isset($_POST['allEtu'])){
                $val =  $_POST['val'] ;
                $type = $_POST['type'] ;
                $result = $etuRip->getbySomefield($type,$val) ;
            }else{
                $result = $etuRip->getAll() ;
              
            }

            return new JsonResponse(array('data'=>json_encode($result))) ;
        }
    }
    



}
