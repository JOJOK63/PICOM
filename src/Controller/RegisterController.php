<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegisterController extends AbstractController
{
    #[Route('/inscription', name: 'register')]
    public function index(): Response
    {
//        création d'un nouveau user
        $user = new User();
//        choix et création d'un formulaire et data à transmettre
        $form = $this->createForm(RegisterType::class, $user);

//        création de la vue et passage de variable au template, pour y accéder dans la vue
        return $this->render('register/index.html.twig', [
// création de la vue du form
            'form' => $form->createView()
        ]);
    }
}
