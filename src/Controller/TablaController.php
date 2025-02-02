<?php

//  src/Controller/TablaController.php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
class TablaController extends AbstractController{

     #[Route('/tabla/', name: 'tabla')]

   public function tabla(){
    $filas = array(array('codigo'=> '1', 'nombre' =>'Sevilla' ),
            array('codigo'=> '2', 'nombre' =>'Madrid' ),
            array('codigo'=> '3', 'nombre' =>'Barcelona' ),
            array('codigo'=> '4', 'nombre' =>'Valencia' ),
            array('codigo'=> '5', 'nombre' =>'Zaragoza' ));

    return $this->render('tabla.html.twig', array ( 'filas' => $filas));
   }

}