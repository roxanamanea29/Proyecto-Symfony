<?php
// src/Controller/Ejemplo.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class Ejempo extends AbstractController {

  //producto route: 127.0.0.1:8000/producto/3/4
  #[Route('/producto/{num1}/{num2}', name: 'producto')]
  public function producto($num1, $num2) {
    $producto = $num1 * $num2;

    return new Response('<html><body>Producto: '.$producto.'</body></html>');
  }

  //producto route: http://http://127.0.0.1:8000/product1
  #[Route('/product1', name: 'product1')]
  public function product(Request $request) {
    $session = $request->getSession(
    );//la session se crea automaticamente en symfony

    if ($request->isMethod('post')) {
      $num1 = $request->request->get('num1');
      $num2 = $request->request->get('num2');
      if (is_numeric($num1) && is_numeric($num2)) {
        $product = $num1 * $num2;
      }
      $session->set('product', $product);//guardar en la session

      // Redirigir para evitar el error de Turbo
      return $this->redirectToRoute(
        'product1'
      );//redirigir a la misma ruta para que me pinte el resultado en la vista del formulario
    }

    return $this->render('product.html.twig', [
      'product' => $session->get('product', NULL),
      // Obtener el resultado de la sesión
    ]);
  }

  //Escribe un controlador que reciba un número y muestre su factorial.
  //Hay que comprobar que el parámetro sea realmente un
  //número y que no sea negativo.

  //factorial route: 127.0.0.1:8000/factorial/5
  #[Route('/factorial/{n}', name: 'factorial')]
  public function factorial($n) {
    if ($n == 0) {//si el numero es 0
      return 1;
    }
    $resultado = 1;
    for ($i = 1; $i <= $n; $i++) {
      $resultado = $resultado * $i;
    }

    return new Response(
      '<html><body>El factorial de '.$n.' es: '.$resultado.'</body></html>'
    );
  }

  //127.0.0.1:8000/cuadrado/5
  #[Route('/cuadrado/{num}', name: 'cuadrado')]
  public function cuadrado($num) {
    return $this->redirectToRoute('producto', ['num1' => $num, 'num2' => $num]);
  }

  //número positivos o negativos
  #[Route('/positivo/{numero}', name: 'positivo')]
  public function positivo($numero) {
    return $this->render('if.html.twig', ['numero' => $numero]);
  }



// factorial con plantilla twig
  //Escribe un controlador que reciba un número y muestre su factorial
  //utilizando una plantilla. La plantilla recibirá el resultado y un parámetro
  //llamado error. Si error es TRUE, en lugar del resultado hay que
  //mostrar un mensaje apropiado.
  //factorial route: 127.0.0.1:8000/factorial1
  #[Route('/factorial1', name: 'factorial1', methods: ['GET', 'POST'])]
  public function factorial1(Request $request) {
    $session = $request->getSession();
      $resultado = null;
      $num= null;

      if($request->isMethod('POST')){
          $num = $request->request->get('num');
          if(is_numeric($num) && $num >= 0){
              $resultado = 1;
              for ($i = 1; $i <= $num; $i++) {
                  $resultado = $resultado * $i;
              }
              $session->set('resultado', $resultado);
              $session->set('num', $num);
          }
        return $this->redirectToRoute(
          'factorial1'
        );//redirigir a la misma ruta para que me pinte el resultado en la vista del formulario
      }

    return $this->render('factorial.html.twig', [
      'resultado' => $session->get('resultado', NULL),
      'num' =>$session->get('num', NULL),

      // Obtener el resultado de la sesión
    ]);
  }

}

