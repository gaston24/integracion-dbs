
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

    function __construct(){

        require_once 'Conexion.php';
        $cid = new Conexion();
        $this->cid_central = $cid->conectarSql('central');

       
    } 

    public function execSpSql ($sp)
    {
        try {

            $sql = "exec [LAKERBIS].locales_lakers.dbo.RO_SP_MAILS_VENTA_SUCURSALES '2023-07-01', '2023-07-02'";

            $stmt = sqlsrv_query($this->cid_central, $sql);

            $next_result = sqlsrv_next_result($stmt);

            $v = [];

            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                // echo json_encode($row); 
                $v[] = $row;
            }

            return $v;

        
        } catch (Exception $e) {
            echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        }
    }
        

}


