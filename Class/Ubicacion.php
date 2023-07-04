
<?php

class Ubicacion
{

    private $codigo_postal;
    private $localidad;
    private $partido;
    private $descripcion_partido;
    private $provincia;
    private $zona;
    private $latitud;
    private $longitu;
    private $cid_mongo = "";
    private $mongo;

    function __construct()
    {
        require_once 'conexion.php';
        $cid = new Conexion();
        $this->cid_central = $cid->conectarSql('central');
        $this->cid_mongo = $cid->conectarMongoDb();
     

    } 

    public function insertOne ($collection, $document) 
    {

        try {

            $mongoCollection = $this->cid_mongo->selectCollection($collection);

            $mongoCollection->insertOne($document);

            return true;

        } catch (\Throwable $th) {

            throw $th;
            
        }

    }
}


