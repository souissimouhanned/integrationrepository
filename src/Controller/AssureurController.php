<?php

namespace App\Controller;

use App\Entity\Assureur;
use App\Form\AssureurType;
use App\Repository\AssureurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/assureur")
 */
class AssureurController extends AbstractController
{
    /**
     * @Route("/", name="assureur_index", methods={"GET"})
     */
    public function index(AssureurRepository $assureurRepository): Response
    {
        return $this->render('assureur/index.html.twig', [
            'assureurs' => $assureurRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="assureur_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $assureur = new Assureur();
        $form = $this->createForm(AssureurType::class, $assureur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($assureur);
            $entityManager->flush();

            return $this->redirectToRoute('assureur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('assureur/new.html.twig', [
            'assureur' => $assureur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="assureur_show", methods={"GET"})
     */
    public function show(Assureur $assureur): Response
    {
        return $this->render('assureur/show.html.twig', [
            'assureur' => $assureur,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="assureur_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Assureur $assureur, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AssureurType::class, $assureur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('assureur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('assureur/edit.html.twig', [
            'assureur' => $assureur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="assureur_delete", methods={"POST"})
     */
    public function delete(Request $request, Assureur $assureur, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$assureur->getId(), $request->request->get('_token'))) {
            $entityManager->remove($assureur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('assureur_index', [], Response::HTTP_SEE_OTHER);
    }
}
