<?php

namespace App\Controller;

use App\Entity\Expositions;
use App\Form\ExpositionsType;
use App\Repository\ExpositionsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/expositions")
 */
class ExpositionsController extends AbstractController
{
    /**
     * @Route("/", name="expositions_index", methods={"GET"})
     */
    public function index(ExpositionsRepository $expositionsRepository): Response
    {
        return $this->render('expositions/index.html.twig', [
            'expositions' => $expositionsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="expositions_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $exposition = new Expositions();
        $form = $this->createForm(ExpositionsType::class, $exposition);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($exposition);
            $entityManager->flush();

            return $this->redirectToRoute('expositions_index');
        }

        return $this->render('expositions/new.html.twig', [
            'exposition' => $exposition,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="expositions_show", methods={"GET"})
     */
    public function show(Expositions $exposition): Response
    {
        return $this->render('expositions/show.html.twig', [
            'exposition' => $exposition,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="expositions_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Expositions $exposition): Response
    {
        $form = $this->createForm(ExpositionsType::class, $exposition);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('expositions_index', [
                'id' => $exposition->getId(),
            ]);
        }

        return $this->render('expositions/edit.html.twig', [
            'exposition' => $exposition,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="expositions_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Expositions $exposition): Response
    {
        if ($this->isCsrfTokenValid('delete'.$exposition->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($exposition);
            $entityManager->flush();
        }

        return $this->redirectToRoute('expositions_index');
    }
}
