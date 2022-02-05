<?php

namespace App\Controller;

use App\Entity\BusStop;
use App\Repository\BusStopRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/stop')]
class BusStopController extends AbstractController
{

    public function __construct(
        private EntityManagerInterface $em,
        private BusStopRepository     $busStopRepository
    )
    {
    }

    #[Route('/', name: 'stops')]
    public function index(): Response
    {
       $busStops = $this->em->getRepository(BusStop::class)->findAll();

        return $this->render('bus_stop/index.html.twig', [
            'busStops' => $busStops,
        ]);
    }
}
