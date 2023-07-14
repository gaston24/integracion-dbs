<?php 
require_once 'Controller/VentasController.php';
require_once 'Class/VentasRepository.php';
require_once 'vendor/autoload.php';
// ejecutarSp();

$mongo = new VentasRepository();
traerDatosVentasSql();
// $hola = ["acasa"=>"asdas"];
// $mongo->insertOne("abc",$hola);


?>