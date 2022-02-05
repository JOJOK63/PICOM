<?php

namespace App\Controller;

use App\Entity\Area;
use App\Entity\BusStop;
use App\Form\BusStopFormType;
use App\Repository\BusStopRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/arrets')]
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

    #[Route('/nouvel-arret', name: 'new_stop')]
    public function newStop(Request $request): Response
    {
        $areas = $this->em->getRepository(Area::class)->findAll();
        $stop = new BusStop();
        $form = $this->createForm(BusStopFormType::class, $stop);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->em->persist($stop);
            $this->em->flush();

            return $this->redirectToRoute('stops');
        }
        return $this->render('bus_stop/form_stop.html.twig', [
            'form' => $form->createView(),
            'stops' => $stop,
            'areas' => $areas
        ]);
    }

    #[Route('/modifier-arret/{id}', name: 'edit_stop')]
    public function editStop(Request $request): Response
    {

        $stop = $this->em->getRepository(BusStop::class)->findOneBy(['id' => $request->get('id')]);

        $form = $this->createForm(BusStopFormType::class, $stop);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            return $this->redirectToRoute('stops');
        }

        return $this->render('bus_stop/form_stop.html.twig', [
            'form' => $form->createView()
        ]);


    }


    #[Route('/supprimer-arret/{id}', name: 'delete_stop')]
    public function deleteStop(Request $request,int $id)
    {
        $stop = $this->em->getRepository(BusStop::class)->findOneBy(['id' => $request->get('id')]);

        if( $stop->getId() == $id){
            $this->em->remove($stop);
            $this->em->flush();
        }
        return $this->redirectToRoute('stops');
    }


}
