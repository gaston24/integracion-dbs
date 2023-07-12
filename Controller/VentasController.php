<?php 
require_once 'Class/VentasRepository.php';
require_once 'Class/Venta.php';
require_once 'Class/Ubicacion.php';



function showSql($table) 
{

    $ventas = new VentasRepository();

    $result = $ventas->showSql($table);

    return $result;


}

function execSpSql($sp) 
{
    $ventas = new VentasRepository();
    $result = $ventas->execSpSql($sp);
    return $result;
    
}

function showMongo($collection) 
{

    $ventas = new VentasRepository();

    $result = $ventas->showMongo($collection);

    return $result;

}

function createCollection ($collectionName)
{
     
    $ventas = new VentasRepository();

    $result = $ventas->createCollection($collectionName);

    return $result;

}

function update($collection,$filter,$update)
{

    $ventas = new VentasRepository();

    $result = $ventas->update($collection,$filter,$update);

    return $result;

}

function deleteOne($collection,$filter,$value)
{

    $ventas = new VentasRepository();

    $result = $ventas->deleteOne($collection,$filter,$value);

    return $result;

}

function pasarSqlAmongoDb($table,$collectionName)
{
    try {
        
        $ventas = new VentasRepository();

        // $result = $ventas->createCollection($collectionName);

        $result = $ventas->showSql($table);
        
        foreach ($result as $key => $res) {
            
            $document = $res;
            var_dump($document);

            // $ventas->insertOne($collectionName,$document);

        }

        return true;

    } catch (\Throwable $th) {

        throw $th;

    }


}

function ejecutarSp(){

    $venta = new Venta();
    $ventasRepository = new VentasRepository();
    $ubicacion = new Ubicacion();
  
    $ubicaciones = $ubicacion->traerUbicaciones();

    $data = $venta->execDoSpSql("RO_SP_MAILS_VENTA_SUCURSALES");
    $ventasRepository->createCollection("Ventas");

    foreach ($data as $key => &$venta) {
        
        $venta['UBICACION'] = "";
        foreach ($ubicaciones as $k => $ubicacion) {
        
            
            if($venta['C_POSTAL'] == $ubicacion['c_postal']){

                $venta['UBICACION'] = json_encode($ubicacion);
                break ;
            }
            
            if($venta['LOCALIDAD'] == $ubicacion['localidad'] || $venta['LOCALIDAD'] == $ubicacion['desc_partido']){

                $venta['UBICACION'] = json_encode($ubicacion);
                break ;
            }

            if($venta['LOCALIDAD_SUCURSAL'] == $ubicacion['localidad'] || $venta['LOCALIDAD_SUCURSAL'] == $ubicacion['desc_partido']){

                $venta['UBICACION'] = json_encode($ubicacion);
                break ;
            }

        
            
        }

        $ventasRepository->insertOne("Ventas",$venta);

    }


}








?>