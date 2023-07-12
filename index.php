<?php 
// Conexión a SQL Server
require 'vendor/autoload.php';
require_once 'Controller\VentasController.php';
require_once 'Class\Ubicacion.php';

// $todosLosElementosMongo = showMongo('paulo23');
// var_dump($todosLosElementosMongo);

// $todosLosElementosSql = showSql('RO_SP_VENTAS_VS_COBRANZA_TOTALES');
// createCollection("prueba");
// pasarSqlAmongoDb("RO_T_ARTICULOS_SIN_CN","paulo2000000");
// var_dump("aca");
// insertDesdeSql();
// Conexión a MongoDB
// crearCollectionYinsertar('local','paulo1');
$result = showMongo('Ventas');




// $archivoJson = 'data.json';

// // Leer el contenido del archivo JSON
// $jsonData = file_get_contents($archivoJson);
// // Decodificar el JSON en un objeto
// $objetoJson = json_decode($jsonData);

// $ubicacion = new Ubicacion();

// $result = $ubicacion->traerUbicaciones();
// var_dump($result);

// foreach ($objetoJson as $key => $value) {
//             // var_dump($value);
//         $ubicacion->insertOne("Ubicacion", $value); 
    
//     }
//     $result = execSpSql("RO_SP_VENTAS_VS_COBRANZA_TOTALES");
//     var_dump($todosLosElementosSql);
// var_dump($result);
foreach ($result as $key => $value) {
    if($value['UBICACION'] != ""){
        var_dump($value);
}
}
?>