<?php

namespace App\Controller;

use App\Entity\Timeslot;
use App\Form\TimeslotFormType;
use App\Repository\TimeslotRepository;
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

    #[Route('/', name: 'timeslots')]
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

            return $this->redirectToRoute('timeslots');
        }
        return $this->render('timeslot/form_timeslot.html.twig', [
            'form' => $form->createView(),
            'timeslots' => $timeslot
        ]);
    }

    #[Route('/modifier-horaire/{id}', name: 'edit_timeslot')]
    public function editTimeslot(Request $request): Response
    {

        $timeslot = $this->em->getRepository(Timeslot::class)->findOneBy(['id' => $request->get('id')]);

        $form = $this->createForm(TimeslotFormType::class, $timeslot);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            return $this->redirectToRoute('timeslots');
        }

        return $this->render('timeslot/form_timeslot.html.twig', [
            'form' => $form->createView()
        ]);


    }


    #[Route('/supprimer-horaire/{id}', name: 'delete_timeslot')]
    public function deleteTimeslot(Request $request,int $id)
    {
        $timeslot = $this->em->getRepository(Timeslot::class)->findOneBy(['id' => $request->get('id')]);

        if( $timeslot->getId() == $id){
            $this->em->remove($timeslot);
            $this->em->flush();
        }
        return $this->redirectToRoute('timeslots');
    }


}
