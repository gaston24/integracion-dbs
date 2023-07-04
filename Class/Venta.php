
<?php

class Venta
{
    private $nro_sucurs;
    private $dni;
    private $dni_orig;
    private $nombre_cli;
    private $domicilio;
    private $localidad;
    private $sexo;
    private $n_comp;
    private $fecha;
    private $rubro;
    private $cod_articu;
    private $desc_cta_articulo;
    private $cantidad;
    private $imp;
    private $desc_promocion_tarjeta;
    private $e_mail;
    private $banco;
    private $rango_etario;
    private $categoria;

    function __construct(){

        require_once __DIR__.'/../../class/conexion.php';
        $cid = new Conexion();
        $this->cid_central = $cid->conectarSql('central');
        $this->cid_central = $cid->conectarMongoDb();
        
       
    } 

    

}


