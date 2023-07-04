<?php 
require_once 'Class/Ubicacion.php';
// Ruta del archivo JSON
$archivoJson = 'data.json';

// Leer el contenido del archivo JSON
$jsonData = file_get_contents($archivoJson);
// Decodificar el JSON en un objeto
$objetoJson = json_decode($jsonData);

$ubicacion = new Ubicacion();
die();

foreach ($objetoJson as $key => $value) {
    
    // insertOne("Ubicacion", $value); 
    
}
// Utilizar el objeto JSON

// echo $objetoJson->c_postal;
// echo $objetoJson->localidad;

?>