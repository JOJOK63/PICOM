<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\PasswordHasher\PasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegisterController extends AbstractController
{

    private $entityManager;

    /**
     * @param $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    #[Route('/inscription', name: 'register')]
    public function index(Request $request, UserPasswordHasherInterface $hasher): Response
    {

//création d'un nouveau user
        $user = new User();

//choix et création d'un formulaire et data à transmettre
        $form = $this->createForm(RegisterType::class, $user);

//permet d'observer la requete et si jamais il y a de la donnée a l'intérieur de réagir en fonction
        $form->handleRequest($request);

// vérification si form transmis et valide par rapport au formType RegisterType
        if($form->isSubmitted() && $form->isValid()){

//si condition rempli alors
            $user = $form->getData();

//hash du mot de passe et ensuite réinjection dans le user
            $password = $hasher->hashPassword($user,$user->getPassword());
            $user->setPassword($password);

// capture des données ensuite sauvegarde en base de données.
            $this->entityManager->persist($user);
            $this->entityManager->flush();

        }

//création de la vue et passage de variable au template, pour y accéder dans la vue
        return $this->render('register/index.html.twig', [
// création de la vue du form
            'form' => $form->createView()
        ]);

    }
}
