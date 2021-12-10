<?php

namespace App\Controller;
use App\Entity\PropertySearch;
use App\Form\PropertySearchType;
use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Knp\Component\Pager\PaginatorInterface; // Nous appelons le bundle KNP Paginator




/**
 * @Route("/user")
 */
class UserController extends AbstractController
{



  /**
    *@Route("",name="user_index")
    */
    public function home(Request $request)
 {
    $propertySearch = new PropertySearch();
    $form = $this->createForm(PropertySearchType::class,$propertySearch);
     $form->handleRequest($request);
 //initialement le tableau des articles est vide, 
 //c.a.d on affiche les articles que lorsque l'utilisateur clique sur le bouton rechercher
  $user= [];
  
 if($form->isSubmitted() && $form->isValid()) {
 //on récupère le nom d'article tapé dans le formulaire
  $nom = $propertySearch->getNom();   
  if ($nom!="") 
    //si on a fourni un nom d'article on affiche tous les articles ayant ce nom
    $user= $this->getDoctrine()->getRepository(User::class)->findBy(['nom' => $nom] );
  else   
    //si si aucun nom n'est fourni on affiche tous les user
    $user= $this->getDoctrine()->getRepository(User::class)->findAll();
 }
  return  $this->render('user/index.html.twig',[ 'form' =>$form->createView(), 'user' => $user]);  
 }
    /**
     * @Route("/", name="user_index", methods={"GET"})
     */
    public function index(Request $request, PaginatorInterface $paginator) // Nous ajoutons les paramètres requis
    {
        // Méthode findBy qui permet de récupérer les données avec des critères de filtre et de tri
        $donnees = $this->getDoctrine()->getRepository(User::class)->findall();

        $userRepository = $paginator->paginate(
            $donnees, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            3 // Nombre de résultats par page
        );
        return $this->render('user/index.html.twig', [
            'users' => $userRepository,
        ]);
    }

    /**
     * @Route("/new", name="user_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager,MailerInterface $mailer): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($user);
            $email = (new Email())
            ->from ('galaxyassurane007@gmail.com')
            ->to($form->get('email')->getData())
            ->subject('Welcome!') 
            ->html('<p>see twig</p>');
            $mailer->send($email);
                        $entityManager->flush();

            return $this->redirectToRoute('user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user/new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_show", methods={"GET"})
     */
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="user_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_delete", methods={"POST"})
     */
    public function delete(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_index', [], Response::HTTP_SEE_OTHER);
    }
}
