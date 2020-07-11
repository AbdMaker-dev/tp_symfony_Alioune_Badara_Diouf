<?php

namespace App\Controller;

use App\Entity\Chambres;
use App\Form\ChambresType;
use App\Repository\ChambresRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/chambres")
 */
class ChambresController extends AbstractController
{
    /**
     * @Route("/chambres", name="chambres_index", methods={"GET"})
     */
    public function index(ChambresRepository $chambresRepository): Response
    {
        return $this->render('chambres/index.html.twig', [
            'chambres' => $chambresRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="chambres_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $chambre = new Chambres();
        $form = $this->createForm(ChambresType::class, $chambre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($chambre);
            $entityManager->flush();

            return $this->redirectToRoute('chambres_index');
        }

        return $this->render('chambres/new.html.twig', [
            'chambre' => $chambre,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="chambres_show", methods={"GET"})
     */
    public function show(Chambres $chambre): Response
    {
        return $this->render('chambres/show.html.twig', [
            'chambre' => $chambre,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="chambres_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Chambres $chambre): Response
    {
        $form = $this->createForm(ChambresType::class, $chambre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('chambres_index');
        }

        return $this->render('chambres/edit.html.twig', [
            'chambre' => $chambre,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="chambres_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Chambres $chambre): Response
    {
        if ($this->isCsrfTokenValid('delete'.$chambre->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($chambre);
            $entityManager->flush();
        }

        return $this->redirectToRoute('chambres_index');
    }
}
