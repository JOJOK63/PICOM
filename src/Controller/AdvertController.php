<?php

namespace App\Controller;

use App\Entity\Advert;
use App\Entity\AdvertImage;
use App\Entity\AdvertText;
use App\Entity\User;
use App\Form\NewAdvertTextFormType;
use App\Repository\AdvertImageRepository;
use App\Repository\AdvertRepository;
use App\Repository\AdvertTextRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/annonces')]
class AdvertController extends AbstractController
{

    public function __construct(
        private EntityManagerInterface $em,
        private AdvertRepository $advertRepository,
        private AdvertImageRepository $advertImageRepository,
        private AdvertTextRepository $advertTextRepository,
    ) {
    }


    #[Route('/', name: 'adverts')]
    public function index(): Response
    {

        $adverts = $this->advertRepository->findAll();
        $advertsImage = $this->advertImageRepository->findAll();
        $advertsText= $this->advertTextRepository->findAll();

//        dd($adverts, $advertsImage, $advertsText);

        return $this->render('advert/index.html.twig', [
            'adverts' => $adverts,
            'advertsImage' => $advertsImage,
            'advertsText' => $advertsText
        ]);
    }

    #[Route('/nouvelle-annonce-text', name: 'new_advert_text')]
    public function newAdvertText(Request $request,UserRepository $user): Response
    {
        $user = new User($this->getUser());

        $advert = new AdvertText();
        $form = $this->createForm(NewAdvertTextFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $advert->setUser($user);
            $advert->setIsPaid(false);
            $this->em->persist($advert);
            $this->em->flush();

            return $this->redirectToRoute('adverts');
        }
        return $this->render('advert/advert_text/new_advert_text.html.twig', [
            'form' => $form->createView(),
            'user' => $user
        ]);
    }

    #[Route('/nouvelle-annonce-image', name: 'new_advert_image')]
    public function newAdvertImage(): Response
    {

        $this->em->persist((new AdvertImage())
            ->setUrl('foo')
            ->setCreatedAt(new \DateTimeImmutable())
            ->setAdvertName('foo')
            ->setIsPaid(false)
        );

        $this->em->flush();

        $adverts = $this->advertRepository->findAll();
        $advertsImage = $this->advertImageRepository->findAll();
        $advertsText= $this->advertTextRepository->findAll();

        dump($adverts, $advertsImage, $advertsText);

        return $this->render('advert/index.html.twig', [
            'controller_name' => 'AdvertController',
        ]);
    }

}
