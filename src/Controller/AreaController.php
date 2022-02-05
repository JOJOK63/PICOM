<?php

namespace App\Controller;

use App\Entity\Area;
use App\Form\AreaFormType;
use App\Repository\AreaRepository;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/zones')]
class AreaController extends AbstractController
{

    public function __construct(
        private EntityManagerInterface $em,
        private AreaRepository         $areaRepository
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
            $area->setMaxBusStop(20);
            $this->em->persist($area);
            $this->em->flush();

            return $this->redirectToRoute('areas');
        }
        return $this->render('area/form_area.html.twig', [
            'form' => $form->createView(),
            'area' => $area
        ]);
    }

    #[Route('/modifier-zone/{id}', name: 'edit_area')]
    public function editArea(Request $request): Response
    {
        $area = $this->em->getRepository(Area::class)->findOneBy(['id' => $request->get('id')]);
        $form = $this->createForm(AreaFormType::class, $area);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            return $this->redirectToRoute('areas');
        }
        return $this->render('area/form_area.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/supprimer-zone/{id}', name: 'delete_area')]
    public function deleteArea(Request $request, int $id): Response
    {
        $area = $this->em->getRepository(Area::class)->findOneBy(['id' => $request->get('id')]);

        if( $area->getId() == $id){
            $this->em->remove($area);
            $this->em->flush();
        }
        return $this->redirectToRoute('areas');
    }


}
