<?php 
require_once 'Class/Venta.php';
$venta = new Venta();
$a = $venta->execSpSql("RO_SP_MAILS_VENTA_SUCURSALES");
var_dump($a);
?>