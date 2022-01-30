<?php

namespace App\Controller;

use App\Entity\Timeslot;
use App\Form\TimeslotFormType;
use App\Repository\TimeslotRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/plage-horaire')]
class TimeslotController extends AbstractController
{


    public function __construct(
        private EntityManagerInterface $em,
        private TimeslotRepository     $timeslotRepository
    )
    {
    }

    #[Route('/', name: 'show_timeslots')]
    public function index(): Response
    {

        $timeslots = $this->timeslotRepository->findAll();

        return $this->render('timeslot/index.html.twig', [
            'timeslots' => $timeslots,
        ]);
    }

    #[Route('/nouvel-horaire', name: 'new_timeslot')]
    public function newTimeslot(Request $request): Response
    {
        $timeslot = new Timeslot();
        $form = $this->createForm(TimeslotFormType::class, $timeslot);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $timeslot->setAdvertLimit(6);
            $this->em->persist($timeslot);
            $this->em->flush();

            return $this->redirectToRoute('show_timeslots');
        }
        return $this->render('timeslot/new_timeslot.html.twig', [
            'form' => $form->createView(),
            'timeslot' => $timeslot
        ]);
    }


}
