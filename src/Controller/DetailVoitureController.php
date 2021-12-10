<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use App\Entity\DetailVoiture;
use App\Form\DetailVoitureType;
use App\Repository\DetailVoitureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/detailvoiture")
 */
class DetailVoitureController extends AbstractController
{
    /**
     * @Route("/", name="detail_voiture_index", methods={"GET"})
     */
    public function index(DetailVoitureRepository $detailVoitureRepository): Response
    {
        return $this->render('detail_voiture/index.html.twig', [
            'detail_voitures' => $detailVoitureRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="detail_voiture_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $detailVoiture = new DetailVoiture();
        $form = $this->createForm(DetailVoitureType::class, $detailVoiture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($detailVoiture);
            $entityManager->flush();

            return $this->redirectToRoute('detail_voiture_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('detail_voiture/new.html.twig', [
            'detail_voiture' => $detailVoiture,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="detail_voiture_show", methods={"GET"})
     */
    // @ParamConverter("id",class="DetailVoiture")
     
    public function show(DetailVoiture $detailVoiture): Response
    {
        return $this->render('detail_voiture/show.html.twig', [
            'detail_voiture' => $detailVoiture,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="detail_voiture_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, DetailVoiture $detailVoiture, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DetailVoitureType::class, $detailVoiture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('detail_voiture_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('detail_voiture/edit.html.twig', [
            'detail_voiture' => $detailVoiture,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="detail_voiture_delete", methods={"POST"})
     */
    public function delete(Request $request, DetailVoiture $detailVoiture, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$detailVoiture->getId(), $request->request->get('_token'))) {
            $entityManager->remove($detailVoiture);
            $entityManager->flush();
        }

        return $this->redirectToRoute('detail_voiture_index', [], Response::HTTP_SEE_OTHER);
    }
}
