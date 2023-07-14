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

function traerDatosVentasSql(){

    $venta = new Venta();
    $ventasRepository = new VentasRepository();
    $ubicacion = new Ubicacion();
  
    $ubicaciones = $ubicacion->traerUbicaciones();

    $arrayFc = [];
    
    $arrayVentas = $venta->execDoSpSql("RO_SP_MAILS_VENTA_SUCURSALES");

    foreach ($arrayVentas as $key => $value) {
        if( !in_array($value['N_COMP'], $arrayFc) ){
            $arrayFc[] = $value['N_COMP'];
        }
    }


    $arrayVentas2 = [];
    $arrayVentasTemp = [];

    $arrayArt = [];


    foreach ($arrayVentas as $k => $v) {

        if($v['CANTIDAD'] > 0){

            $arrayArt[][$v['N_COMP']] = array(

                "COD_ARTICU" => $v['COD_ARTICU'],
                "DESC_CTA_ARTICULO" => $v['DESC_CTA_ARTICULO'],
                "DESC_PROMOCION_TARJETA" => $v['DESC_PROMOCION_TARJETA'],
                "CANTIDAD" => $v['CANTIDAD'],
                "PRECIO" => $v['IMP'],
                "RUBRO" => $v['RUBRO'],
                "CATEGORIA" => $v['CATEGORIA'],

            );

        }
        
        if(!in_array($v['N_COMP'], $arrayVentasTemp)){

            $arrayVentas2[] = array(
                "N_COMP" => $v['N_COMP'],
                "NRO_SUCURS" => $v['NRO_SUCURS'],
                "LOCALIDAD_SUCURSAL" => $v['LOCALIDAD_SUCURSAL'],
                "DNI" => $v['DNI'],
                "DNI_ORIG" => $v['DNI_ORIG'],
                "NOMBRE_CLI" => $v['NOMBRE_CLI'],
                "DOMICILIO" => $v['DOMICILIO'],
                "C_POSTAL" => $v['C_POSTAL'],
                "LOCALIDAD" => $v['LOCALIDAD'],
                "SEXO" => $v['SEXO'],
                "FECHA" => $v['FECHA'],
                "E_MAIL" => $v['E_MAIL'],
                "BANCO" => $v['BANCO'],
                "RANGO_ETARIO" => $v['RANGO_ETARIO'],
                "ARTICULOS" => []
                // faltan mas datos del array, SIN ARTICULO
            );

            $arrayVentasTemp[] = $v['N_COMP'];
        }
    }

    foreach ($arrayVentas2 as $key => $value) {
            
        foreach ($arrayArt as $k => $v) {
            
            foreach ($v as $k2 => $v2) {
                
                if($value['N_COMP'] == $k2){

                    $arrayVentas2[$key]['ARTICULOS'][] = $v2;
                }
            }
        }

    }

    

    

    // agregar ubicacion a cada venta

    $ventasRepository->createCollection("Ventas");

    foreach ($arrayVentas2 as $key => &$venta) {
        
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