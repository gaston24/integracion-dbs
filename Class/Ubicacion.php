
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
    protected $cid_mongo = "";
    private $mongo;

    // private $cid_mongo = "";
    // private $mongo;
    function __construct( $cidParaMongo = null)
    {
        require_once 'conexion.php';
        $cid = new Conexion();
        $this->cid_central = $cid->conectarSql('central');
        $this->cid_mongo = (isset($cidParaMongo)) ? $cidParaMongo : $cid->conectarMongoDb();
     
    } 
    
    public function setMongoConnection($cid_mongo)
    {
        $this->cid_mongo = $cid_mongo;
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

    public function traerUbicaciones (){
        try {

            $mongoCollection = $this->cid_mongo->selectCollection('Ubicacion'); 

            $filter = []; // Filtro vacío para obtener todos los documentos

            $options = [
            'projection' => []
            ]; // Opciones adicionales, como ordenar los resultados, limitarlos, etc.
    
            $result = $mongoCollection->find();

            $newArray = [];
            foreach ($result as $x => $document) {

                $documentArray = $document->getArrayCopy();
        
                // Acceder al campo _id
                $id = (string) $documentArray['_id'];
        
                $newArray[$x]['ID'] = $id;
                // Acceder a los demás campos
                $keys = array_keys($documentArray);
        
                foreach ($keys as $key) {
                    // Saltar el campo _id
                    if ($key === '_id') {
                        continue;
                    }
                    $newArray[$x][$key] = $documentArray[$key];
        
                }
        
            }
    
            return ($newArray);

        } catch (\Throwable $th) {

            throw $th;
            
        }
    }
}


