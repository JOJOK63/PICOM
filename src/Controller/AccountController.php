<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
    #[Route('/compte', name: 'account')]
    public function index(): Response
    {
        return $this->render('account/index.html.twig', [
            'controller_name' => 'AccountController',
        ]);
    }

//voir toutes ses annonces publicitaire
//ajouter une annonce publicitaire
//*  téléverser un fichier PNG ou de rédiger son annonce éditeur HTML
//* choisir sur une carte du réseau la ou les zones de diffusion
//* choisir la ou les tranches horaires de diffusion
//* choisir la date de diffusion date de début , et nombre de jours
//* payer en ligne l’annonce ( numéro de carte | date d’expiration | CVV )
//prolonger une diffusion (entraînant autre paiement )
//voir les diffusions de ses annonces

}
