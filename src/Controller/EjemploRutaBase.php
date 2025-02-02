<?php
// src/Controller/EjemploRutaBase.php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;use function Symfony\Component\String\u;

 #[Route("/base")]

class EjemploRutaBase extends AbstractController{

    #[Route("/hola")]
  public function hola(){
    return new Response('<html><body>Hola probando rutas base </body></html>');
  }
}
