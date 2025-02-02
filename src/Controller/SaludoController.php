<?php
// src/Controller/Ejemplo.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SaludoController extends AbstractController {

  //saludo primer ejemplo
  #[Route('/hola', name: 'hola')]
  public function home() {
    return new Response('<html><body>Hola</body></html>');
  }

  //saludo utilizando twig
  //saludo route: 127.0.0.1:8000/saludo/Roxana
  #[Route('/saludo/{nombre}', name: 'hola_nombre')]
  public function saludo($nombre) {
    return $this->render('saludo.html.twig', ['nombre' => $nombre]);
  }
  //base
  #[Route('/base', name: 'base')]
  public function basep() {
    return $this->render('basep.html.twig');
  }


  //ip del cliente
  #[Route('/testRequest', name: 'testRequest', methods: ['GET'])]
  public function testRequest(Request $request) {
    $ip =$request->getClientIp();
    return new Response('<html><body>IP: '.$ip.'</body></html>');

  }

  #[Route('/session1', name: 'session1')]
public function sesion1(SessionInterface $session){
  $session->set("variable", 123);
  return $this->redirectToRoute('session2');
  }
  #[Route('/session2', name: 'session2')]
  public function sesion2(SessionInterface $session){
    $variable = $session->get("variable", "No hay variable");
    return new Response('<html><body>Variable: '.$variable.' .</body></html>');
  }
}
