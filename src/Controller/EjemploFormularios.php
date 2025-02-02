<?php

//src/Controller/EjemploFormularios.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class EjemploFormularios extends AbstractController {

  #[Route('/formu', name: 'formu')]
  public function formularioHola(Request $request): Response {
    $form = $this->createFormBuilder()
      ->add('nombre', TextType::class, ['required' => true])
      ->add('apellidos', TextType::class, ['required' => true])
      ->add('Enviar', SubmitType::class)
      ->getForm();

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $datos = $form->getData(); // Guardamos los datos del formulario
      return $this->redirectToRoute('result_form', [
        'nombre' => $datos['nombre'],
        'apellidos' => $datos['apellidos']
      ]); // 🔹 Redirigir en lugar de renderizar directamente
    }

    return $this->render('formulario.html.twig', [
      'formulario' => $form->createView(),
    ]);
  }

  #[Route('/result', name: 'result_form')]
  public function resultForm(Request $request): Response {
    $nombre = $request->query->get('nombre');
    $apellidos = $request->query->get('apellidos');
    return $this->render('result_form.html.twig', [
      'nombre'    => $nombre,
      'apellidos' => $apellidos
    ]);
  }
}