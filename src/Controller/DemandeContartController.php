<?php

namespace App\Controller;

use App\Entity\DemandeContart;
use App\Form\DemandeContartType;
use App\Repository\DemandeContartRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Contrat;
use App\Form\ContratType;
use App\Repository\ContratRepository;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/demande_contart")
 */
class DemandeContartController extends AbstractController
{
    /**
     * @Route("/x", name="demande_contart_index", methods={"GET"})
     */
  public function index(Request $request, PaginatorInterface $paginator)  {

     $donnees = $this->getDoctrine()->getRepository(DemandeContart::class)->findAll();

   $demandeContartRepository = $paginator->paginate(
          $donnees, // Requête contenant les données à paginer (ici nos articles)
       $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
        4 // Nombre de résultats par page
      );
       return $this->render('demande_contart/index.html.twig', [
            'demande_contarts' => $demandeContartRepository,
     ]);
  }

    /**
     * @Route("/new", name="demande_contart_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager,MailerInterface $mailer): Response
    {
        $demandeContart = new DemandeContart();
        $form = $this->createForm(DemandeContartType::class, $demandeContart);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($demandeContart);
            $email = (new Email())
                ->from('mohamedamine.ouerghi@esprit.tn')
                ->to($form->get('email')->getData())
                //->cc('cc@example.com')
                //->bcc('bcc@example.com')
                //->replyTo('fabien@example.com')
                //->priority(Email::PRIORITY_HIGH)
                ->subject('Time for Symfony Mailer!')

                ->html('<p>See Twig integration for better HTML integration!</p>');

            $mailer->send($email);
            $entityManager->flush();

            return $this->redirectToRoute('demande_contart_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('demande_contart/new.html.twig', [
            'demande_contart' => $demandeContart,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="demande_contart_show", methods={"GET"})
     */
    public function show(DemandeContart $demandeContart): Response
    {
        return $this->render('demande_contart/show.html.twig', [
            'demande_contart' => $demandeContart,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="demande_contart_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, DemandeContart $demandeContart, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DemandeContartType::class, $demandeContart);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('demande_contart_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('demande_contart/edit.html.twig', [
            'demande_contart' => $demandeContart,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="demande_contart_delete", methods={"POST"})
     */
    public function delete(Request $request, DemandeContart $demandeContart, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $demandeContart->getId(), $request->request->get('_token'))) {
            $entityManager->remove($demandeContart);
            $entityManager->flush();
        }

        return $this->redirectToRoute('demande_contart_index', [], Response::HTTP_SEE_OTHER);
    }


    /**
     * @Route("/", name="demande_contart_admin", methods={"GET"})
     */
    public function admin(DemandeContartRepository $demandeContartRepository): Response
    {

        return $this->render('demande_contart/listcontrats.html.twig', [
            'demande_contarts' => $demandeContartRepository->findBy(['etat'=>0]),
        ]);
    }

    /**
     * @Route("/{id}/approvependingcontrat", name="approvependingcontrat", methods={"GET", "POST"})
     */
    public function approvependingcontrat(Request $request, EntityManagerInterface $entityManager, $id ,DemandeContartRepository $demandeContartRepository): Response
    {
        $demandeContart=$demandeContartRepository->findBy(['etat'=>0]);
        $demandeContart=$demandeContart[0];

        $Contart = new Contrat();
        $form = $this->createForm(ContratType::class, $Contart);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $demandeContart->setEtat(1);
            $Contart->setId($demandeContart->getId());
            $Contart->setCodePostal($demandeContart->getCodePostal());
            $Contart->setNomUser($demandeContart->getNomUser());
            $Contart->setVille($demandeContart->getVille());
            $Contart->setPrenomUser($demandeContart->getPrenomUser());
            $Contart->setNumTel($demandeContart->getNumTel());
            $entityManager->persist($Contart);
            $entityManager->flush();

            return $this->redirectToRoute('demande_contart_admin', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('demande_contart/approvecontrat.html.twig', [
            'demande_contart' => $demandeContart,
            'form' => $form->createView(),
        ]);




    }


}
