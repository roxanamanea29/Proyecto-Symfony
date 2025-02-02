<?php

namespace App\Controller;

use App\Entity\Equipo;
use App\Repository\EquipoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;


final class EquipoController extends AbstractController {

  #[Route('/equipo_list', name: 'app_equipo', methods: ['GET'])]
  public function index(EntityManagerInterface $entityManager)
  {
    // Obtener todos los equipos
    $repository = $entityManager->getRepository(Equipo::class);
    $equipos = $repository->findAll();

    // Pasar la variable 'equipos' a la vista Twig
    return $this->render('equipo.html.twig', [
      'equipos' => $equipos, // Aquí pasas la variable equipos a la plantilla
    ]);
  }
  #[Route('/findEquipo', name: 'findEquipo', methods: ['GET', 'POST'])]
  public function findEquipo(Request $request, EquipoRepository $equipoRepository): Response {
    $equipo = null;
    $id = $request->query->get('id'); // Para GET

    if ($request->isMethod('POST')) {
      $id = $request->request->get('id'); // Para POST
      return $this->redirectToRoute('findEquipo', ['id' => $id]);
    }

    if (is_numeric($id)) {
      $equipo = $equipoRepository->find($id); // Buscar equipo
    }

    return $this->render('findId.html.twig', [
      'equipo' => $equipo
    ]);
  }

}