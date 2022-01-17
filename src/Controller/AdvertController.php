<?php

namespace App\Controller;

use App\Entity\Advert;
use App\Entity\AdvertImage;
use App\Entity\AdvertText;
use App\Repository\AdvertImageRepository;
use App\Repository\AdvertRepository;
use App\Repository\AdvertTextRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/annonces', name: 'adverts')]
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
            'controller_name' => 'AdvertController',
            'adverts' => $adverts,
            'advertsImage' => $advertsImage,
            'advertsText' => $advertsText
        ]);
    }

    #[Route('/nouvelle-annonce-text', name: 'new_advert_text')]
    public function newAdvertText(): Response
    {
        $this->em->persist((new AdvertText())
            ->setContent('Foo')
            ->setCreatedAt(new \DateTimeImmutable())
            ->setAdvertName('foo')
            ->setIsPaid(false)
        );
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