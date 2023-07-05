
<?php

class VentasRepository
{   
    private $cid_mongo = "";
    private $mongo;
    function __construct()
    {
        require_once 'conexion.php';
        $cid = new Conexion();
        $this->cid_central = $cid->conectarSql('central');
        $this->cid_mongo = $cid->conectarMongoDb();
     

    } 


    public function setMongo($mongo)
    {
        $this->mongo = $mongo;
    }

    public function showSql ($table)
    {
        $sql = "SELECT * FROM $table";

        $stmt = sqlsrv_query($this->cid_central, $sql);

        try{
            
            $rows = array();

            while ($v = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)) {

                $rows[] = $v;
            }

            return $rows;
        
        } catch (\Throwable $th){
            print_r($th);
        }

    }

    public function execSpSql ($sp)
    {
        try{            

            require_once 'conexion.php';
            $cidE = new Conexion();
            $conn= $cidE->conectarSql('central');
            
            $sql = "EXEC [LAKERBIS].locales_lakers.dbo.RO_SP_MAILS_VENTA_SUCURSALES '01/07/2023', '04/07/2023'";
            
            // ini_set('max_execution_time', 500);
            
            $stmt = sqlsrv_query($conn, $sql);
  
            $v = [];
            
            var_dump(sqlsrv_fetch_array($stmt));
            die();
            while ($row = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)) {

                $v[] = $row;

            }

            return $v;
        
        } catch (\Throwable $th){
            print_r($th);
        }

    }

    public function showMongo($collection)
    {

        $mongoCollection = $this->cid_mongo->selectCollection($collection);
        

        $filter = []; // Filtro vacío para obtener todos los documentos

        $options = [
        'projection' => []
        ]; // Opciones adicionales, como ordenar los resultados, limitarlos, etc.

        $result = $mongoCollection->find($filter, $options);
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

    }

    public function createCollection ($collectionName)
    {

        try {

            $mongoCollection = $this->cid_mongo->createCollection($collectionName);
            return true;
            
        } catch (\Throwable $th) {

            throw $th;
            
        }
        
    }

    public function update ($collection,$filter,$update) 
    {

        try {

            $mongoCollection = $this->cid_mongo->selectCollection($collection);

            $mongoCollection->updateOne($filter,$update);

            return true;
            
        } catch (\Throwable $th) {

            throw $th;
            
        }

    }
    
    public function deleteOne($collection,$filter,$value) 
    {

        try {

            $mongoCollection = $this->cid_mongo->selectCollection($collection);

            $mongoCollection->deleteOne([$filter => $value]);

            return true;

        } catch (\Throwable $th) {

            throw $th;
            
        }

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


