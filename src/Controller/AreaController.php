<?php

namespace App\Controller;

use App\Entity\Area;
use App\Form\AreaFormType;
use App\Repository\AreaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/zones')]
class AreaController extends AbstractController
{

    public function __construct(
        private EntityManagerInterface  $em,
        private AreaRepository $areaRepository
    )
    {
    }

    #[Route('/', name: 'areas')]
    public function index(): Response
    {

        $areas = $this->areaRepository->findAll();

        return $this->render('area/index.html.twig', [
            'areas' => $areas,
        ]);
    }

    #[Route('/nouvel-zone', name: 'new_area')]
    public function newArea(Request $request): Response
    {
        $area = new Area();
        $form = $this->createForm(AreaFormType::class, $area);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->em->persist($area);
            $this->em->flush();

            return $this->redirectToRoute('show_timeslots');
        }
        return $this->render('area/new_area.html.twig', [
            'form' => $form->createView(),
            'area' => $area
        ]);
    }
}
