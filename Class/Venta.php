
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
    private $cid_central;
    private $cid_locales;

    function __construct(){

        require_once 'Conexion.php';
        $cid = new Conexion();
        $this->cid_locales = $cid->conectarSql('locales');
       
    } 

    
    public function execDoSpSql ($sp)
    {
        try {

            $desde = date("Y-m-d", strtotime("-1 day"));

            $hasta = date("Y-m-d");

            $sql = "exec $sp '$desde', '$hasta'";

            $stmt = sqlsrv_query($this->cid_locales, $sql);

            $next_result = sqlsrv_next_result($stmt);

            $v = [];

            do {
                
                while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                    $v[] = $row;
                }

            } while (sqlsrv_next_result($stmt));

            return $v;

        
        } catch (Exception $e) {
            echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        }
    }
        

}


